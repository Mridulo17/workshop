<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ContentRequest;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.content.{$link}";
    }

    public function index()
    {
        $content = Content::query();
        if (request()->ajax()) {
            return \Datatables::of($content)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    $name = Content::findcontentType($data->name);
                    return $name;
                })
                ->addColumn('action', function ($data) {
                    $action_array = [
                        'id' => $data->id
                    ];
                    $action = \App\Helpers\MenuHelper::TableActionButton($action_array);
                    return $action;
                })
                ->rawColumns(['name','action'])
                ->make(true);
        } else {
            return view($this->path('index'));
        }
    }

    public function create()
    {
        return view($this->path('create'));
    }

    public function store(ContentRequest $request)
    {
        try {
            $content = New Content();
            $content->create($request->all());

            \Toastr::success('Content Created', 'Success');
            return redirect(route('content.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Content $content)
    {
        //
    }

    public function edit(Content $content)
    {
        $data['content'] = $content;
        return view($this->path('edit'))->with($data);
    }

    public function update(ContentRequest $request, Content $content)
    {
        try {
            $content->update($request->all());
            \Toastr::success('Content Updated', 'Success');
            return redirect(route('content.index'));
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Content $content)
    {
        $content->deleted_by = \Auth::id();
        $content->save();
        $content->delete();
        return response()->json([
            'message' => 'Content deleted'
        ]);
    }
}
