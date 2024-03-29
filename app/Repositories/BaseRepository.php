<?php


namespace App\Repositories;


use App\Helpers\ImageHelper;
use App\Helpers\MenuHelper;
use App\Models\File;
use App\Models\Menu;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaseRepository
{
    protected $model;
    protected $trans;

    public function __construct($model,$trans = null){
        $this->model = $model;
        $this->trans = $trans;
    }

    public function datatable(array $relations = null, $make_true = null){
        $datatable = \Datatables::of($relations? $this->model->with($relations) : $this->query())
            ->addIndexColumn()
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status','LIKE', "%{$keyword}%");
            })
            ->addColumn('action', function($data){
                $action_array = [
                    'id' => $data->id,
                ];
                $action = '';
                $action .= MenuHelper::TableActionButton($action_array);
                return $action;
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
            ->rawColumns(['action','status']);

        if($make_true != null){
            return $datatable;
        }else{
            return $datatable->make(true);
        }
    }

    public function deletedDatatable(array $relations = null,$make_true = null){
        $datatable = \Datatables::of($relations? $this->model->with($relations)->onlyTrashed() : $this->model->onlyTrashed())
            ->addIndexColumn()
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status','LIKE', "%{$keyword}%");
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
                $action .= MenuHelper::TableActionButton($action_array);
                return $action;
            })
            ->rawColumns(['action','status']);

            if($make_true != null){
                return $datatable;
            }else{
                return $datatable->make(true);
            }
    }

    public function query(){
        return $this->model::query();
    }

    public function pluck($where_array = null)
    {
        return $this->model::where([['status','Active'],[$where_array]])->pluck('bn_name','id');
    }

    public function get($where_array = null)
    {
        return $this->model::where([[$where_array]])->get();
    }


    public function selectRawPluck(array $params = null)
    {
        return $this->model::where([['status','Active'],[@$params['where']]])->selectRaw(@$params['columns'])->pluck($params['pluck']['key'],$params['pluck']['value']);
    }
    public function find($id){
        return $this->model::find($id);
    }

    public function all(){
        return $this->model::all();
    }

    public function create(object $data, array $parameters = null){
        DB::beginTransaction();
        try {
            foreach ($data->all() as $key => $value){
                if (substr_count($key,'date') > 0){
                    $data[$key] = $value ? date('Y-m-d',strtotime($value)) : null;
                }
            }

            $data['created_by'] = \Auth::id();
            $last_data = $this->model::create($data->all());

            if(@$parameters['create_many']){
                $this->createManyRelation($last_data,$parameters);
            }

            //image uploads
            $image_array = @$parameters['image_info'];
            if ($image_array){
                foreach($image_array as $image_info){
                    if($image_info['images']) {
                        if (!is_array($image_info['images'])) {
                            $image_info['images'] = [$image_info['images']];
                        }
                        foreach ($image_info['images'] as $image) {
                            $image_parameters = [
                                'image' => $image,
                                'directory' => $image_info['directory'],
                                'width' => @$image_info['width'],
                                'height' => @$image_info['height'],
                            ];
                            $source = ImageHelper::Image($image_parameters);
                            $file_parameter = [
                                'source' => $source,
                                'type' => $image_info['type'],
                                'created_by' => $last_data->created_by,
                            ];
                            $file = new File($file_parameter);
                            $last_data->files()->save($file);
                        }
                    }
                }
            }

            DB::commit();
            if($data->ajax() == true){
                return response()->json([
                    'data' => $last_data,
                    'message' => trans('common.created',['model' => $this->getTranslateKey()]),
                ],200);
            }else{
                Toastr::success(trans('common.created',['model' => $this->getTranslateKey()]),trans('common.success'));
                return redirect(route($this->getModelNameLower().'.index'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            if($data->ajax() == true){
                return response()->json($e->getMessage(), 500);
            }else{
                Toastr::error(trans('common.error').'</br>'.$e->getMessage(),trans('common.failed'));
                return back()->withInput()->with('error', $e->getMessage());
            }
        }
    }

    public function createManyRelation($last_data, $parameters){
        foreach ($parameters['create_many'] as $create_many){
            $create_many['data'] = collect($create_many['data'])->map(function($item) {
                $item['created_by'] = auth()->user()->id;
                foreach ($item as $key => $value){
                    if (substr_count($key,'date') > 0){
                        $item[$key] = $value ? date('Y-m-d',strtotime($value)) : null;
                    }
                }
                return $item;
            });
            $create_many_relation = $create_many['relation'];
            $relation_items = $last_data->$create_many_relation()->createMany($create_many['data']);
            foreach ($create_many['data'] as $key => $create_many_relations){
               if(@$create_many_relations['create_many']){
                   $last_data = $relation_items[$key];
                   $parameters = $create_many_relations;
                   $this->createManyRelation($last_data,$parameters);
               }
            }

        }
    }

    public function update($id, object $data, array $parameters = null){
        DB::beginTransaction();
        try {
            foreach ($data->all() as $key => $value){
                if (substr_count($key,'date') > 0){
                    $data[$key] = $value ? date('Y-m-d',strtotime($value)) : null;
                }
            }

            $data['updated_by'] = \Auth::id();
            $last_data = $this->model::find($id);
            $last_data->update($data->all());

            //save relational data
            if(@$parameters['create_many']){
                $this->updateManyRelation($last_data,$parameters);
            }

            //image uploads
            $image_array = @$parameters['image_info'];
            if($last_data->files != null){
                $last_data->files()->update(['deleted_by'=> \Auth::id()]);
                if(@$data->delete_images != null){
                    $data->delete_images = explode(",", $data->delete_images);
                    $last_data->files()->whereIn('id', $data->delete_images)->delete();
                }
            }

            if ($image_array){
                foreach($image_array as $image_info){
                    if($image_info['images']) {
                        if (!is_array($image_info['images'])) {
                            $image_info['images'] = [$image_info['images']];
                        }
                        foreach ($image_info['images'] as $image) {
                            $image_parameters = [
                                'image' => $image,
                                'directory' => $image_info['directory'],
                                'width' => @$image_info['width'],
                                'height' => @$image_info['height'],
                            ];
                            $source = ImageHelper::Image($image_parameters);
                            $file_parameter = [
                                'source' => $source,
                                'type' => $image_info['type'],
                                'created_by' => $last_data->created_by,
                                'updated_by' => $last_data->updated_by,
                            ];
                            $file = new File($file_parameter);
                            $last_data->files()->save($file);
                        }
                    }
                }
            }

            DB::commit();
            if($data->ajax() == true){
                return response()->json([
                    'data' => $last_data,
                    'message' => trans('common.updated',['model' => $this->getTranslateKey()]),
                ],200);
            }else{
                Toastr::success(trans('common.updated',['model' => $this->getTranslateKey()]), trans('common.success'));
                return redirect(route($this->getModelNameLower().'.index'));
            }

        } catch (\Exception $e) {
            DB::rollBack();
            if($data->ajax() == true){
                return response()->json($e->getMessage(), 500);
            }else{
                Toastr::error(trans('common.error').'</br>'.$e->getMessage(),trans('common.failed'));
                return back()->withInput()->with('error', $e->getMessage());
            }
        }
    }

    public function updateManyRelation($last_data, $parameters){
        foreach ($parameters['create_many'] as $create_many){
            $create_many['data'] = collect($create_many['data'])->map(function($item) use ($last_data) {
                $item['created_by'] = $last_data->created_by;
                $item['updated_by'] = $last_data->updated_by;
                foreach ($item as $key => $value){
                    if (substr_count($key,'date') > 0){
                        $item[$key] = $value ? date('Y-m-d',strtotime($value)) : null;
                    }
                }
                return $item;
            });
            $create_many_relation = $create_many['relation'];

            if ($last_data->$create_many_relation()->first() != null){
                $table = $last_data->$create_many_relation->first()->getTable();
                $last_data->$create_many_relation()->forceDelete();
                $last_id = DB::table($table)->max('id');
                if($last_id){
                    \DB::statement("ALTER TABLE `$table` AUTO_INCREMENT =  $last_id");
                }else{
                    \DB::statement("ALTER TABLE `$table` AUTO_INCREMENT =  1");
                }
            }
            $relation_items = $last_data->$create_many_relation()->createMany($create_many['data']);foreach ($create_many['data'] as $key => $create_many_relations){
                if(@$create_many_relations['create_many']){
                    $last_data = $relation_items[$key];
                    $parameters = $create_many_relations;
                    $this->updateManyRelation($last_data,$parameters);
                }
            }
        }
    }

    public function delete($id, array $relations = null){
        try {
            $data = $this->model::find($id);
            $data->deleted_by = \Auth::id();
            $data->save();
            if($data->files != null){
                $data->files()->delete();
            }
            if(@$relations != null){
                foreach ($relations as $relation){
                    $data->$relation()->delete();

                }
            }
            $data->destroy($id);
            return response()->json([
                'message' => trans('common.deleted',['model' => $this->getTranslateKey()])
            ],200);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function restore($id, array $relations = null){
        try {
            $data = $this->model::withTrashed()->find($id);
            if($data->files != null){
                $data->files()->restore();
            }
            $data->restore();
            if(@$relations != null){
                foreach ($relations as $relation){
                    $data->$relation()->restore();
                }
            }
            return response()->json([
                'message' => trans('common.restored',['model' => $this->getTranslateKey()])
            ],200);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function forceDelete($id, array $relations = null){
        try {
            $data = $this->model::withTrashed()->find($id);
            if($data->files != null){
                $data->files()->forceDelete();
            }
            if(@$relations != null){
                foreach ($relations as $relation){
                    $data->$relation()->forceDelete();

                }
            }
            $data->forceDelete($id);
            return response()->json([
                'message' => trans('common.permanently_deleted',['model' => $this->getTranslateKey()])
            ],200);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function with(array $relations = null){
        return $this->model->with($relations);
    }

    private function getModelName(){
        return explode('App\Models\\',get_class($this->model),2)[1];
    }

    private function getTranslateKey(){
        $routeName = explode('.',\Route::currentRouteName());
        $menu = Menu::where('route_name',$routeName[0].".index")->first();
        if($this->trans){
            return $this->trans;
        }elseif (@$menu){
            return $menu->bn_name;
        }
    }

    private function getModelNameLower(){
        return Str::snake(explode('App\Models\\',get_class($this->model),2)[1]);
    }

}
