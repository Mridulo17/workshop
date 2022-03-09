<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Menu;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserMenuAction;
use App\Models\UserPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.role.{$link}";
    }

    public function index()
    {
        if(auth()->user()->role_id != $this->super_role){
            $role = Role::where('id','!=',$this->super_role)->orderBy('id','asc');
        }else{
            $role = Role::orderBy('id','asc');
        }
        if(request()->ajax()){
            return \Datatables::of($role)
                ->addIndexColumn()
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
            return view($this->path('index'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['role'] = [];
        return view($this->path('create'),$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $role = New Role();
            $role = $role->create($request->all());
            \Toastr::success('Role Created', 'Success');
            return redirect(route('role.permission',$role->id));
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
     * @param Role $role
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $data['role'] = $role;
        return view($this->path('edit'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Role $role
     * @return void
     */
    public function update(Role $role, RoleRequest $request)
    {
        try {
            $role->update($request->all());

            \Toastr::success('Role Updated', 'Success');
            return redirect(route('role.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return void
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'message' => 'Data deleted'
        ]);
    }

    public function permission($id)
    {
        $data['role'] = Role::findOrFail($id);
        $data['menus'] = Menu::where('parent_id',null)->where('status',1)->get();
        $data['user_menu_action'] = UserMenuAction::where('status',1)->get();
        $data['menu_permission'] = RolePermission::where('permission_type','menu')->where('role_id',$id)->pluck('permission_id')->toArray();
        $data['menu_action_permission'] = RolePermission::where('permission_type','menu_action')->where('role_id',$id)->pluck('permission_id')->toArray();

        if(count(request()->all()) > 0 && request()->isMethod('POST')){

            \DB::beginTransaction();
            try {
                RolePermission::where('role_id',$id)->delete();
                $last_id = RolePermission::max('id');
                if($last_id){
                    \DB::statement("ALTER TABLE role_permissions AUTO_INCREMENT =  $last_id");
                }else{
                    \DB::statement("ALTER TABLE role_permissions AUTO_INCREMENT =  1");
                }

                if(request()->menu_id) {
                    $countMenu = count(request()->menu_id);
                    for ($i = 0; $i < $countMenu; $i++) {
                        $menu = Menu::findOrFail(request()->menu_id[$i]);
                        $role_permission = new RolePermission();
                        $role_permission->role_id = $id;
                        $role_permission->permission_id = request()->menu_id[$i];
                        $role_permission->route_name = $menu->route_name;
                        $role_permission->permission_type = 'menu';
                        $role_permission->save();
                    }
                }

                if(request()->user_menu_action_id) {
                    $countUserMenuAction = count(request()->user_menu_action_id);
                    for ($j = 0; $j < $countUserMenuAction; $j++) {
                        $user_menu_action = UserMenuAction::findOrFail(request()->user_menu_action_id[$j]);
                        $role_permission = new RolePermission();
                        $role_permission->role_id = $id;
                        $role_permission->permission_id = request()->user_menu_action_id[$j];
                        $role_permission->route_name = $user_menu_action->route_name;
                        $role_permission->permission_type = 'menu_action';
                        $role_permission->save();
                    }
                }

                $users = User::where('role_id',$id)->where('permission_as_role','Yes')->get();
                $this->permissionUpdateFroUser($users);

                \Toastr::success('Role Permission Updated', 'Success');
                \DB::commit();
            }catch (\Exception $e) {
                \DB::rollBack();
                return back()->withInput()->with('error', $e->getMessage());
            }
            return redirect(route('role.index'));
        }else{
            return view($this->path('permission'))->with($data);
        }

    }

    public function getRolePermission(Request $request){
        $role_id = $request->role_id;
        $data = [
            'menu_permission' => RolePermission::where('permission_type','menu')->where('role_id',$role_id)->pluck('permission_id')->toArray(),
            'menu_action_permission' => RolePermission::where('permission_type','menu_action')->where('role_id',$role_id)->pluck('permission_id')->toArray()
        ];

        return $data;
    }

    public function permissionUpdateFroUser($users){
        foreach ($users as $user){
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
    }
}
