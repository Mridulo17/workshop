<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuActionRequest;
use App\Models\MenuAction;
use Illuminate\Http\Request;

class MenuActionController extends Controller
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
        return "admin.menu-action.{$link}";
    }
    public function index()
    {
        $menu_action_list = MenuAction::query();
        if(request()->ajax()){
            return \Datatables::of($menu_action_list)
                ->addIndexColumn()
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
                    $action .= '<a class="btn btn-info btn-sm" href="'.route('menu-action.edit',$data->id).'"><i class="fa fa-edit"></i></a>';
                    $action .= '<a class="btn btn-danger btn-sm destroy" href="'.route('menu-action.destroy',$data->id).'"><i class="fa fa-trash-alt"></i></a>';
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
        return view($this->path('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuActionRequest $request)
    {
        try {
            $menu_action = New MenuAction();
            $menu_action->create($request->all());

            \Toastr::success('Menu Action Created', 'Success');
            return redirect(route('menu-action.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuAction  $menuAction
     * @return \Illuminate\Http\Response
     */
    public function show(MenuAction $menuAction)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuAction  $menuAction
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuAction $menuAction)
    {
        $data['menuAction'] = $menuAction;
        return view($this->path('edit'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuAction  $menuAction
     * @return \Illuminate\Http\Response
     */
    public function update(MenuActionRequest $request, MenuAction $menuAction)
    {
        try {
            $menuAction->update($request->all());
            \Toastr::success('Menu Action Updated', 'Success');
            return redirect(route('menu-action.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuAction  $menuAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuAction $menuAction)
    {
        $menuAction->delete();
        return response()->json([
            'message' => 'Data deleted'
        ]);
    }
}
