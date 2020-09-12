<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('pages.admin.user.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'level' => 'required|in:Administrator,Kasir',
            'photo' => 'required|file|mimetypes:image/jpg,image/png,image/jpeg|max:1024'
        ]);

        $data = $request->except(['password', 'photo']);
        $data['password'] = Hash::make($request->password);
        $data['photo'] = $request->photo->store('images/users', 'public');

        if (User::create($data)) {
            return redirect()->route('user.index')->with([
                'alert' => [
                    'type' => 'success',
                    'msg' => 'Berhasil menambahkan pengguna ' . $request->name
                ]
            ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.admin.user.edit', [
            'user' => $user
        ]);
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

        $user = User::find($id);

        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username,' . $id,
            'password' => 'nullable|string',
            'level' => 'required|in:Administrator,Kasir',
            'photo' => 'nullable|file|mimetypes:image/jpg,image/png,image/jpeg|max:1024'
        ]);
        $data = $request->except(['password', 'photo']);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->has('photo')) {
            $data['photo'] = $request->photo->store('images/users', 'public');
        }

        if ($user->update($data)) {

            return redirect()->route('user.index')->with([
                'alert' => [
                    'type' => 'success',
                    'msg' => 'Berhasil mengubah data ' . $user->name
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->delete()) {
            return response()->json(['msg' => 'sukses']);
        }
    }
}
