<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Interfaces\WorkshopInterface;
use App\Models\District;
use App\Models\Division;
use App\Models\Employee;
use App\Models\FireStation;
use App\Models\Menu;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\UserPermission;
use App\Models\User;
use App\Models\UserMenuAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $workshop;
    public function __construct(WorkshopInterface $workshop)
    {
        $this->workshop = $workshop;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.user.{$link}";
    }

    public function index(Request $request)
    {

        $counts = [];
        $type = $request->type;
        $users = User::with('role');
        if(auth()->user()->role_id != $this->super_role){
            $users->where('role_id','!=',$this->super_role);
        }
        if(request()->ajax()){
            return \Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('role', function($data){
                    $role = '';
                    $role .= @$data->role->name;
                    return $role;
                })
                ->addColumn('district', function($data){
                    $district = '';
                    $district .= @$data->district->bn_name;
                    return $district;
                })
                ->addColumn('status', function($data){
                    $status = '';
                    if($data->status == 'Active'){
                        $status .= '<span class="badge badge-soft-success font-size-11 fw-bold">Active</span>';
                    }elseif ($data->status == 'Inactive'){
                        $status .= '<span class="badge badge-soft-pink font-size-11 fw-bold">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($data){
                    $action_array = [
                        'id' => $data->id
                    ];
                    $action = '';
                    $action .= \App\Helpers\MenuHelper::TableActionButton($action_array);
                    return $action;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }else{
            return view($this->path('index'),$counts);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role_id != $this->super_role){
            $roles = Role::query()->where('status','Active')->where('id','!=',$this->super_role)->pluck('name','id');
        }else{
            $roles = Role::query()->where('status','Active')->pluck('name','id');
        }
        $data = array(
            'divisions' => Division::query()->where('status','Active')->pluck('bn_name','id'),
            'districts' => District::query()->where('status','Active')->pluck('bn_name','id'),
            'fire_stations' => FireStation::query()->where('status','Active')->pluck('bn_name','id'),
            'roles' => $roles,
            'workshops' => $this->workshop->pluck(),
            'employers' => collect(Employee::where('status','Active')->get())
                ->mapWithKeys(function ($item) {
                    return [
                        $item->id => $item->name ." (".$item->old_pin.'/'.$item->new_pin. ")"
                    ];
                })->all(),
        );
        return view($this->path('create'))->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $user = New User();
            $data = $request->all();
            if($data['password']){
                $data['password'] =  bcrypt($data['password']);
            }
            $data['user_type'] = 'admin';
            $data['permission_as_role'] = 'Yes';
            $user = $user->create($data);
            $user->markEmailAsVerified();
            $this->permissionUpdateFromRole($user);

            \Toastr::success('User Created', 'Success');
            return redirect(route('user.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
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
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(auth()->user()->role_id != $this->super_role){
            $roles = Role::query()->where('status','Active')->where('id','!=',$this->super_role)->pluck('name','id');
        }else{
            $roles = Role::query()->where('status','Active')->pluck('name','id');
        }

        $data = array(
            'divisions' => Division::query()->where('status','Active')->pluck('bn_name','id'),
            'districts' => District::query()->where('status','Active')->pluck('bn_name','id'),
            'fire_stations' => FireStation::query()->where('status','Active')->pluck('bn_name','id'),
            'roles' => $roles,
            'user' => $user,
            'workshops' => $this->workshop->pluck(),
            'employers' => collect(Employee::where('status','Active')->get())
                ->mapWithKeys(function ($item) {
                    return [
                        $item->id => $item->name ." (".$item->old_pin.'/'.$item->new_pin. ")"
                    ];
                })->all(),
        );

        return view($this->path('edit'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return void
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $data = $request->all();
            if($data['password']){
                $data['password'] =  bcrypt($data['password']);
                $user->update($data);
            }else{
                $data = $request->except(['password']);
                $user->update($data);
            }

            if($user->permission_as_role == 'Yes'){
                $this->permissionUpdateFromRole($user);
            }

            if($user->email_verified_at == null){
                $user->markEmailAsVerified();
            }

            \Toastr::success('User Updated', 'Success');
            return redirect(route('user.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'Data deleted'
        ]);
    }

    public function permission($id)
    {
        $data['user'] = User::findOrFail($id);
        $data['role'] = $data['user']->role;
        $data['menus'] = Menu::where('parent_id',null)->where('status',1)->get();
        $data['user_menu_action'] = UserMenuAction::where('status',1)->get();
        $data['menu_permission'] = UserPermission::where('permission_type','menu')->where('user_id',$id)->pluck('permission_id')->toArray();
        $data['menu_action_permission'] = UserPermission::where('permission_type','menu_action')->where('user_id',$id)->pluck('permission_id')->toArray();
        return view($this->path('permission'))->with($data);
    }

    public function permissionUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $last_id = UserPermission::max('id');
        if($last_id){
            \DB::statement("ALTER TABLE user_permissions AUTO_INCREMENT =  $last_id");
        }else{
            \DB::statement("ALTER TABLE user_permissions AUTO_INCREMENT =  1");
        }

        if($request->permission_as_role){
            $this->permissionUpdateFromRole($user);
            $user->update([
               'permission_as_role' => 'Yes'
            ]);
        }else{
            $this->permissionUpdateFromInput($user,$request->all());
            $user->update([
                'permission_as_role' => 'No'
            ]);
        }

        \Toastr::success('User Permission Updated', 'Success');
        return redirect(route('user.index'));

        return view($this->path('permission'))->with($data);

    }

    public function permissionUpdateFromRole($user){
        UserPermission::where('user_id',$user->id)->delete();
        $role_permissions = RolePermission::where('role_id',$user->role_id)->get();
        foreach ($role_permissions as $permission){
            $user_permission = new UserPermission();
            $user_permission->user_id = $user->id;
            $user_permission->permission_id = $permission->permission_id;
            $user_permission->route_name = $permission->route_name;
            $user_permission->permission_type = $permission->permission_type;
            $user_permission->save();
        }
    }

    public function permissionUpdateFromInput($user,$data){
        UserPermission::where('user_id',$user->id)->delete();
        if($data['menu_id']) {
            $countMenu = count($data['menu_id']);
            for ($i = 0; $i < $countMenu; $i++) {
                $menu = Menu::findOrFail($data['menu_id'][$i]);

                $user_permission = new UserPermission();
                $user_permission->user_id = $user->id;
                $user_permission->permission_id = $data['menu_id'][$i];
                $user_permission->route_name = $menu->route_name;
                $user_permission->permission_type = 'menu';
                $user_permission->save();
            }
        }

        if($data['user_menu_action_id']) {
            $countUserMenuAction = count($data['user_menu_action_id']);
            for ($j = 0; $j < $countUserMenuAction; $j++) {
                $user_menu_action = UserMenuAction::findOrFail($data['user_menu_action_id'][$j]);
                $user_permission = new UserPermission();
                $user_permission->user_id = $user->id;
                $user_permission->permission_id = $data['user_menu_action_id'][$j];
                $user_permission->route_name = $user_menu_action->route_name;
                $user_permission->permission_type = 'menu_action';
                $user_permission->save();
            }
        }
    }

    public function profile()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $data = array(
            'user' => $user,
        );
        return view($this->path('profile'))->with($data);
    }

    public function profileUpdate(ProfileRequest $request, $id)
    {
        $user = User::find($id);
        try {
            if ($request->signature) {
                @unlink($user->signature);
            }

            if($request->password){
                $request->request->add(['password' => bcrypt($request->password)]);
                $user->update($request->all());
            }else{
                $user->update($request->except('password'));

            }

            if ($request->signature) {
                $signature = ImageHelper::Image(request('signature'),'signature');
                @unlink($user->signature);
                $user->update([
                    'signature' => $signature
                ]);
            }

            \Toastr::success('Profile Updated', 'Success');
            return back();
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
