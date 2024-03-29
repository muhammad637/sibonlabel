<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ruangan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        // return User::with('ruangan')->get();
        return view('admin.pages.User.listUser', [
            'users' => User::with('ruangan')->orderBy('created_at', 'desc')->get(),
            'title' => 'user',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ruangan = Ruangan::all()->sortBy('nama_ruangan');
        return response(view('admin.pages.User.createUser', [
            'ruangans' => $ruangan,
            'title' => 'Create User'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notif = Notifikasi::notif('user', "user: $request->nama berhasil di tambahkan by " . auth()->user()->nama, 'tambah', 'berhasil');
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'cekLevel' => 'required',
            'no_telephone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
            'nik' => 'required|unique:users,nik|max:16'
        ]);
        try {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData);
            Notifikasi::create($notif)->user()->sync(User::adminId());
            $user = User::where('username', $request->username)->first();
            // cek apakah request level adalah admin
            // if ($validatedData['cekLevel'] == 'admin' ) {
            //     # kosongkan request->ruangan = []
            //     $dataR =  !$request->ruangan;
            // }else{
            //     $dataR =  $request->ruangan;
            // }
            // if ($dataR) {
            //     # code...
            //     foreach ($request->ruangan as $index => $val) {
            //         // dd($val);
            //         # code...
            //         Ruangan::where('id', $val)->update(['user_id' => $user->id]);
            //     }
            // }
            if ($validatedData['cekLevel'] == "admin") {
                # code...
                return redirect('/master/user')->with('toast_success', $notif['msg']);
            } else {
                # code...
                // $cek = count($request->ruangan) > 0;
                if ($request->ruangan > 0) {
                    # code...
                    // $user = 
                    $user->ruangan()->sync($request->ruangan);
                    // foreach ($request->ruangan as $key => $index) {
                    //     # code..
                    //     // Ruangan::where('id',$index)->update(['user_id' => $user->id]);
                    // }
                }
            }

            return redirect('/master/user')->with('toast_success', $notif['msg']);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            $notif['msg'] = "user: $request->nama gagal ditambahkan";
            $notif['status'] = 'gagal';
            Notifikasi::create($notif)->user()->sync(User::adminId());
            return redirect()->back()->with('toast_error', $th->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        // return $user->ruangan;
        return response(view('admin.pages.User.editUser', [
            'ruangans' => Ruangan::all()->sortBy('nama_ruangan'),
            'user' => $user,
            'title' => 'Edit User',
            // 'ruanganUser' => $ruanganUser
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //code...
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required |' . Rule::unique('users')->ignore($user->id),
            'password' => '',
            'nik' => 'required|max:16'. Rule::unique('users,nik')->ignore($user->id),
            'cekLevel' => 'required',
            'no_telephone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);
        try {
            //code...
            if ($validatedData['password']  == null) {
                $validatedData['password'] = $user->password;
            } else {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }

            User::where('id', $user->id)->update($validatedData);
            $notif = Notifikasi::notif('user', "user: $request->nama berhasil diupdate by " . auth()->user()->nama, 'update', 'berhasil');
            Notifikasi::create($notif)->user()->sync(User::adminId());
            foreach ($user->ruangan as $item) {
                Ruangan::where('id', $item->id)->update(['user_id' => null]);
            }
            if ($validatedData['cekLevel'] == 'admin') {
                # kosongkan request->ruangan = []
                return redirect(route('user.index'))->with('toast_success', $notif['msg']);
            } else {
                // $cek = count($request->ruangan) >= 1;
                if ($request->ruangan > 0) {
                    $user->ruangan()->sync($request->ruangan);
                    // foreach ($request->ruangan as $index => $id) {
                    //     Ruangan::where('id', $id)->update(['user_id' => $user->id]);
                    //     // return Ruangan::where('id', $val)->get();
                    // }
                }
            }
            return redirect(route('user.index'))->with('toast_success', $notif['msg']);
        } catch (\Throwable $th) {
            //throw $th;
            $notif['msg'] = 'data user ' . $user->nama . ' gagal diupdate';
            $notif['status'] = 'gagal';
            Notifikasi::create($notif);
            return redirect()->back()->with('toast_error', $th->getMessage());
        }
    }


    public function updatev2(Request $request, User $user)
    {

        $notif = Notifikasi::notif('user', "data anda berhasil diupdate", 'update', 'berhasil');
        $validatedData = $request->validate([
            'no_telephone' => 'required',
            'nama' => 'required'
        ]);
        Notifikasi::create($notif)->user()->attach(auth()->user()->id);
        $user->update($validatedData);
        return redirect('/profile')->with('toast_success', $notif['msg']);
    }

    public function passwordProfile(Request $req, User $user)
    {
        // try {
        //code...
        $notif = Notifikasi::notif('user', 'password berhasil diupdate', 'update', 'berhasil');
        $req->validate([
            'old_password' => ['required'],
            'password' => ['required', 'min:8'],
        ], [
            'password.confirmed' => 'The new password confirmation does not match.',
        ]);
        if (!Hash::check($req->old_password, $user->password)) {
            # code...
            return redirect()->back()->with('toast_error', 'password lama tidak valid');
        }
        if ($req->password == $req->password_confirmation) {
            $user->update([
                'password' => Hash::make($req->password),
            ]);
            Auth::logout();
            $req->session()->invalidate();
            $req->session()->regenerateToken();
            $req->session()->flash('toast_success', $notif['msg']);
            return redirect('/login');
            // return back();
        } else {
            # code...
            return redirect()->back()->with('toast_error', 'passwrd baru dan konfirmasi password tidak sesuai');
        }





        // $validatedData = $req->validate([
        //     'password' => 'required|min:8',
        //     'newPassword' => 'required|min:8',
        // ]);
        // $password = Hash::check($validatedData['password'], $user->password);
        // if ($password) {
        //     # code...
        //     $user->update(['password' => Hash::make($validatedData['newPassword'])]);
        //     Auth::logout();
        //     $req->session()->invalidate();
        //     $req->session()->regenerateToken();
        //     return redirect('/login')->with('toast_success', $notif['msg']);
        // } else {
        //     $notif['msg'] = 'password gagal diupdate';
        //     $notif['status'] = 'gagal';
        //     return redirect()->back()->with('toast_error', $notif['msg']);
        // }
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return $th->getMessage();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function nonaktif(User $user)
    {
        $notif = Notifikasi::notif('user', 'user ' . "$user->nama  berhasil dinonaktifkan by " . auth()->user()->nama, 'nonaktif', 'berhasil');
        $status = 'nonaktif';
        User::where('id', $user->id)->update(['status' => $status]);
        Notifikasi::create($notif)->user()->sync(User::adminId());
        return redirect()->back()->with('toast_success', $notif['msg']);
    }
    public function aktif(User $user)
    {
        //code...
        $notif = Notifikasi::notif('user', 'user ' . "$user->nama berhasil diaktifkan by " . auth()->user()->nama, 'aktif', 'berhasil');
        Notifikasi::create($notif)->user()->sync(User::adminId());
        $status = 'aktif';
        User::where('id', $user->id)->update(['status' => $status]);
        return redirect()->back()->with('toast_success', $notif['msg']);
    }
}
