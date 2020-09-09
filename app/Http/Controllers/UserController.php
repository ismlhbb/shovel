<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \App\User::paginate(4);

        //tangkap terlebih dahulu request variabel bernama 'keyword` dan 'status'
        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');

        // check jika ada $filterKeyword maka kita query User yang emailnya memiliki sebagian dari keyword
        if ($filterKeyword) {
            if ($status) {
                $users = \App\User::where('email', 'LIKE', "%$filterKeyword%")
                    ->where('status', $status)
                    ->paginate(10);
            } else {
                $users = \App\User::where('email', 'LIKE', "%$filterKeyword%")
                    ->paginate(10);
            }
        }

        //cek jika $status memiliki nilai maka kita gunakan untuk query model User berdasarkan status, jika tidak maka query model User tanpa status
        if ($status) {
            $users = \App\User::where('status', $status)->paginate(10);
        } else {
            $users = \App\User::paginate(10);
        }
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_user = new \App\User;
        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->roles = json_encode($request->get('roles'));
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));

        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars', 'public');
            $new_user->avatar = $file;
        }

        $new_user->save();
        return redirect()->route('users.create')->with('status', 'User successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //mencari user dengan id tertentu
        $user = \App\User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
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
        //cari terlebih dahulu user yang akan diedit
        $user = \App\User::findOrFail($id);

        // ubah nilai properti user di atas dengan nilai yang berasal dari form
        $user->name = $request->get('name');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');

        // cek jika terdapat request bertipe file dengan nama 'avatar',
        if ($request->file('avatar')) {
            // Jika terdapat file upload 'avatar' maka kita cek lagi, apakah user yang 
            // akan diedit ini memiliki file avatar dan apakah file tersebut ada di server kita, jika ada maka kita hapus file tersebut.
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                Storage::delete('public/' . $user->avatar);
            }
            // simpan file yang diupload ke folder "avatars" 
            $file = $request->file('avatar')->store('avatars', 'public');

            //set field 'avatar' user dengan path baru dari image yang diupload tadi
            $user->avatar = $file;
        }
        //update ke database dengan method save()
        $user->save();
        return redirect()->route('users.edit', [$id])->with('status', 'User succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //cari terlebih dahulu user yang akan didelete
        $user = \App\User::findOrFail($id);

        //hapus user tersebut
        $user->delete();

        //redirect kembali ke halaman list user dengan pesan bahwa delete telah berhasil
        return redirect()->route('users.index')->with('status', 'User successfully deleted');
    }
}
