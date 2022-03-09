<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverRequest;
use App\Interfaces\DriverInterface;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\ProductInterface;
use App\Models\Driver;
use App\Models\DriverAssign;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    protected $driver;
    protected $employee;
    protected $product;

    public function __construct(DriverInterface $driver, EmployeeInterface $employee, ProductInterface $product){
        $this->driver = $driver;
        $this->employee = $employee;
        $this->product = $product;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.driver.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            $datatable = $this->driver->datatable(['employee','employee.fire_station','employee.workshop','driver_assigns'],'false');

            $datatable
                ->addColumn('products', function($data){
                    $products = '';
                    foreach ($data->driver_assigns as $key => $driver_assign){
                        $products.= $driver_assign->product->tracking_no.'<br>';
                    }
                    return $products;
                })
                ->filterColumn('products', function($query,$keyword){
                    $products = $this->product->query()->where('tracking_no','LIKE',"%{$keyword}%")->get();
                    $driver_ids = [];
                    foreach ($products as $product){
                        $driver_assigns = DriverAssign::query()->where('product_id',$product->id)->get();
                        foreach ($driver_assigns as $driver_assign){
                            array_push($driver_ids,$driver_assign->driver_id);
                        }
                    }
                    $query->whereIn('id',$driver_ids)->get();
                });

            return $datatable->rawColumns(['action','status','products'])->make(true);
        }else{
            return view($this->path('index'));
        }
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            $datatable = $this->driver->deletedDatatable(['employee','employee.fire_station','employee.workshop','driver_assigns'],'false');

            $datatable->addColumn('products', function($data){
                $products = '';
                foreach ($data->driver_assigns as $key => $driver_assign){
                    $products.= 1+$key.'. '.$driver_assign->product->bn_name.'<br>';
                }
                return $products;
            });

            return $datatable->rawColumns(['action','status','products'])
                ->make(true);
        }
    }

    public function create(){
        $data = [
            'title' => trans('common.create',['model' => trans('driver.driver')]),
            'form_action' => route('driver.store'),
            'method' => 'post',
            'included_path' => 'admin.driver.form',
            'employees' => $this->employee->pluck(),
            'products' => $this->product->pluck(),
        ];

        return ModalHelper::content($data);
    }

    public function store(DriverRequest $request){
        $data = $request;
        $parameters = [];
        return $this->driver->create($data, $parameters);
    }

    public function show(Driver $driver){
        //
    }

    public function edit(Driver $driver){
        $data = [
            'title' => trans('common.edit',['model' => trans('driver.driver')]),
            'form_action' => route('driver.update',$driver->id),
            'method' => 'patch',
            'model' => $driver,
            'included_path' => 'admin.driver.form',
            'employees' => $this->employee->pluck(),
            'products' => $this->product->pluck(),
        ];

        return ModalHelper::content($data);
    }

    public function update(DriverRequest $request, Driver $driver){
        $data = $request;
        $parameters = [];
        return $this->driver->update($driver->id,$data,$parameters);
    }

    public function destroy(Driver $driver){
        return $this->driver->delete($driver->id);
    }

    public function restore($id){
        return $this->driver->restore($id);
    }

    public function forceDelete($id){
        return $this->driver->forceDelete($id);
    }
}
