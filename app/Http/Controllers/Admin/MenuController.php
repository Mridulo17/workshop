<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\UserMenuAction;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MenuRequest;

use App\Models\Menu;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.menu.{$link}";
    }

    public function index()
    {
        $menu_list = Menu::with('parent','children');
        if(request()->ajax()){
            return \Datatables::of($menu_list)
                ->addIndexColumn()
                ->addColumn('parent', function($data){
                    $parent = '';
                    $parent .= @$data->parent->name;
                    return $parent;
                })
                ->addColumn('status', function($data){
                    $status = '';
                    if($data->status == 1){
                        $status .= '<span class="badge badge-soft-success font-size-11 fw-bold">Active</span>';
                    }elseif ($data->status == 0){
                        $status .= '<span class="badge badge-soft-pink font-size-11 fw-bold">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($data){
                    $action = '';
                    $action .= '<a class="btn btn-primary btn-sm" href="'.route('user_menu_action.index',$data->id).'"><i class="fa fa-eye"></i></a>';
                    $action .= '<a class="btn btn-info btn-sm" href="'.route('menu.edit',$data->id).'"><i class="fa fa-edit"></i></a>';
                    $action .= '<a class="btn btn-danger btn-sm destroy" href="'.route('menu.destroy',$data->id).'"><i class="fa fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['parent','status','action'])
                ->make(true);
        }else{
            return view($this->path('index'));
        }

    }

    public function create()
    {
        $data['menus'] = Menu::pluck('name','id');
        $data['roles'] = Role::pluck('name','id');
        return view($this->path('create'))->with($data);
    }

    public function store(MenuRequest $request)
    {
        try {
            $menu = New Menu();
            $menu = $menu->create($request->all());

            $parent_id = '';

            if ($request->actions != null){
                foreach ($request->actions as $action => $value){
                    $user_menu_action = $this->actionBuilder($action,$menu->id,$menu->route_name);
                    $user_menu_action->save();
                    if ($action == 'deleted_list'){
                        $parent_id = $user_menu_action->id;
                    } elseif ($action == 'restore' || $action == 'permanent_delete'){
                        $user_menu_action->update(['parent_id' => $parent_id]);
                    }
                }
            }

            \Toastr::success('Menu Created', 'Success');
            return redirect(route('menu.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    private function actionBuilder($action,$menu_id,$route = null){

        if ($action == 'create'){
            return new UserMenuAction([
                'menu_id' => $menu_id,
                'menu_action_id' => 1,
                'name' => 'Add',
                'bn_name' => 'সংযোজন',
                'route_name' => $route ? explode('.',$route)[0].'.create' : null,
                'type' => 'action',
                'slug' => 'create',
                'order_by' => 1,
                'is_hidden' => 'No',
                'show_in_table' => 0,
                'new_tab' => 0,
                'status' => 1,
            ]);
        } elseif ($action == 'edit'){
            return new UserMenuAction([
                'menu_id' => $menu_id,
                'menu_action_id' => 2,
                'name' => 'Edit',
                'bn_name' => 'পরিমার্জন',
                'route_name' => $route ? explode('.',$route)[0].'.edit' : null,
                'type' => 'action',
                'slug' => 'edit',
                'order_by' => 2,
                'is_hidden' => 'No',
                'show_in_table' => 1,
                'new_tab' => 0,
                'status' => 1,
            ]);
        } elseif ($action == 'delete'){
            return new UserMenuAction([
                'menu_id' => $menu_id,
                'menu_action_id' => 3,
                'name' => 'Delete',
                'bn_name' => 'ডিলেট',
                'route_name' => $route ? explode('.',$route)[0].'.destroy' : null,
                'type' => 'action',
                'slug' => 'delete',
                'order_by' => 4,
                'is_hidden' => 'No',
                'show_in_table' => 1,
                'new_tab' => 0,
                'status' => 1,
            ]);
        } elseif ($action == 'view'){
            return new UserMenuAction([
                'menu_id' => $menu_id,
                'menu_action_id' => 4,
                'name' => 'View',
                'bn_name' => 'ভিউ',
                'route_name' => $route ? explode('.',$route)[0].'.show' : null,
                'type' => 'action',
                'slug' => 'view',
                'order_by' => 3,
                'is_hidden' => 'No',
                'show_in_table' => 1,
                'new_tab' => 0,
                'status' => 1,
            ]);
        } elseif ($action == 'print'){
            return new UserMenuAction([
                'menu_id' => $menu_id,
                'menu_action_id' => 9,
                'name' => 'Print',
                'bn_name' => 'প্রিন্ট',
                'route_name' => $route ? explode('.',$route)[0].'.print' : null,
                'type' => 'action',
                'slug' => 'print',
                'order_by' => 5,
                'is_hidden' => 'No',
                'show_in_table' => 1,
                'new_tab' => 1,
                'status' => 1,
            ]);
        } elseif ($action == 'deleted_list'){
            return new UserMenuAction([
                'menu_id' => $menu_id,
                'name' => 'Trash',
                'bn_name' => 'ডিলেটেড লিস্ট',
                'route_name' => $route ? explode('.',$route)[0].'.deleted_list' : null,
                'type' => 'tab',
                'slug' => 'deleted_list',
                'order_by' => 6,
                'is_hidden' => 'No',
                'show_in_table' => 0,
                'new_tab' => 0,
                'status' => 1,
            ]);
        } elseif ($action == 'restore'){
            return new UserMenuAction([
                'menu_id' => $menu_id,
                'menu_action_id' => 10,
                'name' => 'Restore',
                'bn_name' => 'পুনরুদ্ধার',
                'route_name' => $route ? explode('.',$route)[0].'.restore' : null,
                'type' => 'action',
                'slug' => 'restore',
                'order_by' => 7,
                'is_hidden' => 'No',
                'show_in_table' => 1,
                'new_tab' => 0,
                'status' => 1,
            ]);
        } elseif ($action == 'permanent_delete'){
            return new UserMenuAction([
                'menu_id' => $menu_id,
                'menu_action_id' => 3,
                'name' => 'Delete Permanently',
                'bn_name' => 'স্থায়ীভাবে ডিলেট',
                'route_name' => $route ? explode('.',$route)[0].'.force_destroy' : null,
                'type' => 'action',
                'slug' => 'force_destroy',
                'order_by' => 8,
                'is_hidden' => 'No',
                'show_in_table' => 1,
                'new_tab' => 0,
                'status' => 1,
            ]);
        }
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        $data['menu'] = $menu;
        $data['menus'] = Menu::pluck('name','id');
        $data['roles'] = Role::pluck('name','id');
        return view($this->path('edit'))->with($data);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        try {
            $menu->update($request->all());

            \Toastr::success('Menu Updated', 'Success');
            return redirect(route('menu.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json([
            'message' => 'Data deleted'
        ]);
    }
}
