<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ENTOBN;
use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\DriverAssignRequest;
use App\Interfaces\DriverAssignInterface;
use App\Interfaces\DriverInterface;
use App\Interfaces\ProductInterface;
use App\Models\Driver;
use App\Models\DriverAssign;
use Illuminate\Database\Eloquent\Collection;

class DriverAssignController extends Controller
{
    protected $driver_assign;

    public function __construct(DriverAssignInterface $driver_assign, DriverInterface $driver, ProductInterface $product)
    {
        $this->driver_assign = $driver_assign;
        $this->driver = $driver;
        $this->product = $product;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.driver_assign.{$link}";
    }

    public function index()
    {
        if(request()->ajax()){
            return $this->driver_assign->datatable(['driver','driver.employee','driver.employee.workshop','driver.employee.fire_station','product']);
        }
        return view($this->path('index'));
    }

    public function deletedListIndex()
    {
        if (request()->ajax()){
            return $this->driver_assign->deletedDatatable(['driver','driver.employee','driver.employee.workshop','driver.employee.fire_station','product']);
        }
    }

    public function create()
    {
        $all_drivers = Driver::query()->where('status','Active')->get();
        $drivers = Collection::empty();
        foreach ($all_drivers as $item){
            $drivers[$item->id] = $item->employee->bn_name.' ['.ENTOBN::convert_to_bangla($item->employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($item->employee->new_pin).']';
        }
        $selectProductRawParamsWhere = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'where' => [
                'type_id'=> 1,
            ],
        ];
        $data = [
            'title' => trans('common.create',['model' => trans('driver_assign.driver_assign')]),
            'form_action' => route('driver_assign.store'),
            'method' => 'post',
            'included_path' => 'admin.driver_assign.form',
            'drivers' => $drivers,
            'product' => '',
            'products' => $this->product->selectRawPluck($selectProductRawParamsWhere),
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function store(DriverAssignRequest $request)
    {
        return $this->driver_assign->create($request);
    }

    public function show(DriverAssign $driver_assign)
    {
        //
    }

    public function edit(DriverAssign $driver_assign)
    {
        $all_drivers = Driver::query()->where('status','Active')->get();
        $drivers = Collection::empty();
        foreach ($all_drivers as $item){
            $drivers[$item->id] = $item->employee->bn_name.' ['.ENTOBN::convert_to_bangla($item->employee->old_pin).']'.' ['.ENTOBN::convert_to_bangla($item->employee->new_pin).']';
        }
        $selectProductRawParamsWhere = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'where' => [
                'type_id'=> 1,
            ],
        ];
        $product = $this->product->find($driver_assign->product_id);
        $data = [
            'title' => trans('common.edit',['model' => trans('driver_assign.driver_assign')]),
            'form_action' => route('driver_assign.update',$driver_assign->id),
            'method' => 'patch',
            'model' => $driver_assign,
            'included_path' => 'admin.driver_assign.form',
            'drivers' => $drivers,
            'driver_inactive_warning' => $driver_assign->driver->status == 'Inactive' ? trans('driver_assign.product_inactive_warning') : null,
            'product' => $product,
            'products' => $this->product->selectRawPluck($selectProductRawParamsWhere),
            'product_inactive_warning' => $product->status == 'Inactive' ? trans('driver_assign.product_inactive_warning') : null,
        ];

        $modal_content = ModalHelper::content($data);

        return $modal_content;
    }

    public function update(DriverAssignRequest $request, DriverAssign $driver_assign)
    {
        return $this->driver_assign->update($driver_assign->id,$request);
    }

    public function destroy(DriverAssign $driver_assign)
    {
        return $this->driver_assign->delete($driver_assign->id);
    }

    public function restore($id){
        return $this->driver_assign->restore($id);
    }

    public function forceDelete($id){
        return $this->driver_assign->forceDelete($id);
    }

}
