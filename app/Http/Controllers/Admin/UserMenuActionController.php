<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuActionRequest;
use App\Http\Requests\Admin\UserMenuActionRequest;
use App\Models\Menu;
use App\Models\MenuAction;
use App\Models\UserMenuAction;
use Illuminate\Http\Request;

class UserMenuActionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.user-menu-action.{$link}";
    }

    public function index($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);
        $user_menu_action = UserMenuAction::with('menu')->where('menu_id',$menu_id);
        if(request()->ajax()){
            return \Datatables::of($user_menu_action)
                ->addIndexColumn()
                ->addColumn('parent_menu', function($data){
                    $parent_menu = '';
                    $parent_menu .= $data->menu->name;
                    return $parent_menu;
                })
                ->addColumn('type_name', function($data){
                    $type = '';
                    $type .= UserMenuAction::getType($data->type);
                    return $type;
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
                    $action .= '<a class="btn btn-info btn-sm" href="'.route('user_menu_action.edit',['menu_id' => $data->menu_id,'id' => $data->id]).'"><i class="fa fa-edit"></i></a>';
                    $action .= '<a class="btn btn-danger btn-sm destroy" href="'.route('user_menu_action.destroy',['menu_id' => $data->menu_id,'id' => $data->id]).'"><i class="fa fa-trash-alt"></i></a>';
                    return $action;
                })
                ->rawColumns(['parent_menu','status','action'])
                ->make(true);
        }else{
            return view($this->path('index'))->with(compact('menu'));
        }
    }

    public function create($menu_id)
    {
        $data['menu'] = Menu::findOrFail($menu_id);
        $data['menu_action_list'] = MenuAction::pluck('name','id');
        $data['parent_user_menu_actions'] = UserMenuAction::where('menu_id',$menu_id)->pluck('name','id');
        return view($this->path('create'))->with($data);
    }

    public function store(UserMenuActionRequest $request,$menu_id)
    {
        try {
            $data = $request->all();
            $user_menu_action = New UserMenuAction();
            $data['menu_id'] = $menu_id;
            $user_menu_action->create($data);

            \Toastr::success('User Menu Action Created', 'Success');
            return redirect(route('user_menu_action.index',$menu_id));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($menu_id,$id)
    {
        $data['menu'] = Menu::findOrFail($menu_id);
        $data['menu_action_list'] = MenuAction::pluck('name','id');
        $data['user_menu_action'] = UserMenuAction::findOrFail($id);
        $data['parent_user_menu_actions'] = UserMenuAction::where('menu_id',$menu_id)->pluck('name','id');
        return view($this->path('edit'))->with($data);
    }

    public function update(UserMenuActionRequest $request,$menu_id,$id)
    {
        try {
            $data = $request->all();
            $user_menu_action = UserMenuAction::findOrFail($id);
            $data['menu_id'] = $menu_id;
            $user_menu_action->update($data);

            \Toastr::success('User Menu Action Updated', 'Success');
            return redirect(route('user_menu_action.index',$menu_id));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($menu_id,$id)
    {
        $user_menu_action = UserMenuAction::findOrFail($id);
        $user_menu_action->delete();
        return response()->json([
            'message' => 'Data deleted'
        ]);
    }
}
