<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{UserAddRequest};
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Image;
use Auth;
use App;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(User::class, 'view');
        // $response = $this->authorize(User::class,'index');
        if($request->ajax())
        {
            $users = new User;
            $users = $users->paginate(config('openlink.perpage'));
            return response()->json($users);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        $this->authorize(User::class, 'create');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
        ]);
        $roles = $request->roles;
        foreach ($roles as $rol) {
            $role = Role::find($rol);
            if($role)
            {
                $user->assignRole($role);
            }
        }
        return response()->json($request);

        $user = User::create($request->all());
        return response()->json($user);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('edit',User::class);
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // $this->authorize('edit',User::class);
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->only([
            'name', 'email',
        ]));
        if($request->password)
        {
            $user->update(['password' => Hash::make($request->password)]);
        }
        return response()->json($user);
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
    }
    /**
     * 
     * Get roles catalog
     */
    public function roles()
    {
        $this->authorize('edit',User::class);
        return response()->json(Role::all(['id','name']));
    }
    /**
     * Update roles
     * @author @gnujach
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRoles(Request $request) {
        $rol_valido = false;
        $roles = $request->roles;
        $user = User::findOrFail($request->user_id);
        foreach ($roles as $rol) {
            $role = Role::find($rol);
            if($role)
            {
                $rol_valido = true;
            }
        }
        if ($rol_valido)
            $user->syncRoles($roles);
        return response()->json($user);
    }
    public  function update_avatar(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('avatar')) {
                $avatar = $request->get('avatar');
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($avatar, 0, strpos($avatar, ';')))[1])[1];
                Image::make($avatar)->resize(300, 300)->save(\public_path('/assets/img/avatar/' . $fileName));
                $user = Auth::user();
                $user->avatar = $fileName;
                $user->save();
                return response()->json($user);
            }
        }
        return view('profile', array('user' => Auth::user()));
    }
}
