<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\Models\User;
use App\Models\LogSiswa;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $users = User::orderBy('id', 'DESC')->paginate(10);
        $filterKeyword = $request->get('name');

        if ($filterKeyword) {
            $users = User::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:2',
            'password' => 'required|min:2|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // log data
        $log = new LogSiswa;
        $log->user_id = Auth::user()->id;
        $log->method = 'Membuat User Baru';
        $log->save();

        return redirect()->route('users.index')->with(['success' => 'User created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        // dd('user');
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
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
        //
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email, ' . $id,
            'username' => 'required|min:2',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        // log data
        $log = new LogSiswa;
        $log->user_id = Auth::user()->id;
        $log->method = 'Perbarui Data User';
        $log->save();

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        if ($request->filled('oldpassword')) {
            $request->validate([
                'oldpassword' => 'required|min:3|max:255',
                'password' => 'required|min:3|max:255',
                'password_confirmation' => 'required_with:password|same:password|min:3|max:255'
            ]);

            $hashedPassword = Auth::user()->password;

            if (\Hash::check($request->oldpassword, $hashedPassword)) {
                if (!\Hash::check($request->password, $hashedPassword)) {
                    $users = User::find(Auth::user()->id);
                    $users->password = bcrypt($request->password);
                    User::where('id', Auth::user()->id)->update(array('password' => $users->password));
                    return redirect()->back()->with(['success' => 'Update Profile Success']);
                } else {
                    return redirect()->back()->with(['error' => 'Password baru tidak boleh sama dengan password lama!']);
                }
            } else {
                return redirect()->back()->with(['error' => 'Password Lama Tidak sama']);
            }
        } else {
            $request->validate([
                'name' => 'min:3|string'
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->save();

            return redirect()->back()->with(['success' => 'Update Profile Success']);
        }
    }
}
