<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        // OTORISASI GATE
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-orders')) return $next($request);
            abort(403, 'You do not have access to this page.');
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $categories = \App\Category::where("name", "LIKE", "%$keyword%")->get();

        return $categories;
    }

    public function index(Request $request)
    {
        $categories = \App\Category::paginate(10);
        //menangkap request dari form filter
        $filterKeyword = $request->get('name');
        //cek jika $filterKeyword memiliki nilai maka kita gunakan variable tersebut untuk memfilter model Category yang akan kita lempar ke view
        if ($filterKeyword) {
            $categories = \App\Category::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        Validator::make($request->all(), [
            "name" => "required|min:3|max:20",
            "image" => "required"
        ])->validate();

        //menangkap request dengan nama 'name' ke dalam variabel $name 
        $name = $request->get('name');

        //kemudian membuat sebuah instance dari model Category baru dan memberikan nilai name = $name
        $new_category = new \App\Category;
        $new_category->name = $name;

        //melakukan pengecekkan apakah ada request bertipe file dengan nama 'image'
        if ($request->file('image')) {
            // Jika ada maka kita simpan file tersebut ke dalam folder storage/app/public/category_images
            $image_path = $request->file('image')
                ->store('category_images', 'public');
            $new_category->image = $image_path;
            // mengambil nilai id dari user yang sedang login dan berikan ke field created_by
            $new_category->created_by = Auth::user()->id;
            //menggenerate slug berdasarkan nama kategori
            $new_category->slug = Str::slug($name, '-');
            //simpan model kategori baru tersebut ke database
            $new_category->save();
            return redirect()->route('categories.create')->with('status', 'Category successfully created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = \App\Category::findOrFail($id);

        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mencari Category yang id nya bernilai sesuai dengan nilai dari $id (route parameter), 
        $category_to_edit = \App\Category::findOrFail($id);
        //kemudian kita lempar data tersebut sebagai variabel $category ke view categories.edit
        return view('categories.edit', ['category' => $category_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //cari Category yang sedang diedit
        $category = \App\Category::findOrFail($id);

        //validasi
        Validator::make($request->all(), [
            "name" => "required|min:3|max:20",
            "image" => "required",
            "slug" => [
                "required",
                Rule::unique("categories")->ignore($category->slug, "slug")
            ]
        ])->validate();

        //tangkap masing-masing field text
        $name = $request->get('name');
        $slug = $request->get('slug');

        //berikan field-field yang diedit dengan nilai dari request yang kita tangkap
        $category->name = $name;
        $category->slug = $slug;

        //mengecek apakah ada file image yang diupload jika ada kita juga perlu mengupdate field image, 
        if ($request->file('image')) {
            //dan sebelum menyimpan image baru kita juga perlu mengecek apakah kategori yang diedit ini memiliki image sebelumnya di server, 
            if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
                //jika ada kita hapus file tersebut,
                Storage::delete('public/' . $category->name);
            }
            //baru setelah itu assign image path yang baru
            $new_image = $request->file('image')->store('category_images', 'public');

            $category->image = $new_image;
        }
        $category->updated_by = Auth::user()->id;
        $category->slug = Str::slug($name);
        $category->save();
        return redirect()->route('categories.edit', [$id])->with('status', 'Category succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Category successfully moved to trash');
    }


    public function trash()
    {
        $deleted_category = \App\Category::onlyTrashed()->paginate(10);

        return view('categories.trash', ['categories' => $deleted_category]);
    }

    public function restore($id)
    {
        $category = \App\Category::withTrashed()->findOrFail($id);

        if ($category->trashed()) {
            $category->restore();
        } else {
            return redirect()->route('categories.index')
                ->with('status', 'Category is not in trash');
        }

        return redirect()->route('categories.index')
            ->with('status', 'Category successfully restored');
    }

    public function deletePermanent($id)
    {
        $category = \App\Category::withTrashed()->findOrFail($id);

        if (!$category->trashed()) {
            return redirect()->route('categories.index')
                ->with('status', 'Can not delete permanent active category');
        } else {
            $category->forceDelete();

            return redirect()->route('categories.index')
                ->with('status', 'Category permanently deleted');
        }
    }
}
