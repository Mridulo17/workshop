<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModalHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Interfaces\DesignationInterface;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\FireStationInterface;
use App\Interfaces\WorkshopInterface;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employee;
    protected $designation;
    protected $workshop;
    protected $fire_station;

    public function __construct(EmployeeInterface $employee, DesignationInterface $designation, WorkshopInterface $workshop, FireStationInterface $fire_station){
        $this->employee = $employee;
        $this->designation = $designation;
        $this->workshop = $workshop;
        $this->fire_station = $fire_station;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.employee.{$link}";
    }

    public function index(){
        if(request()->ajax()){
            return $this->employee->datatable(['designation','workshop','fire_station']);
        }else{
            return view($this->path('index'));
        }
    }

    public function deletedListIndex(){
        if (request()->ajax()){
            return $this->employee->deletedDatatable(['designation','workshop','fire_station']);
        }
    }

    public function create(){
        $data['designations'] = $this->designation->pluck();
        $data['workshops'] = $this->workshop->pluck();
        $data['fire_stations'] = $this->fire_station->pluck();
        $data['religions'] = Employee::religions();
        $data['genders'] = Employee::genders();
        $data['employees'] = $this->employee->pluck();

        return view($this->path('create'))->with($data);
    }

    public function store(EmployeeRequest $request){
        $data = $request;
        $data['birth_date'] = date('Y-m-d',strtotime($request->birth_date));

        $parameters = [
            'image_info' => [
                [
                    'type' => 'profile_picture',
                    'images' => $data->profile_picture,
                    'directory' => 'profile_pictures',
                    'input_field' => 'profile_picture',
                    'width' => '',
                    'height' => '',
                ],
                [
                    'type' => 'signature',
                    'images' => $data->signature,
                    'directory' => 'signatures',
                    'input_field' => 'signature',
                    'width' => '',
                    'height' => '',
                ],
            ],
        ];

        return $this->employee->create($data,$parameters);
    }

    public function show(Employee $employee){
        //
    }

    public function edit(Employee $employee){
        $data['employee'] = $employee;
        $data['designations'] = $this->designation->pluck();
        $data['workshops'] = $this->workshop->pluck();
        $data['fire_stations'] = $this->fire_station->pluck();
        $data['religions'] = Employee::religions();
        $data['genders'] = Employee::genders();
        $data['employees'] = $this->employee->pluck();
        return view($this->path('edit'))->with($data);
    }

    public function update(EmployeeRequest $request, Employee $employee){
        $data = $request;
        $data['birth_date'] = date('Y-m-d',strtotime($request->birth_date));
        if ($data['remove_profile_picture'] == 'on') {$data['profile_picture'] = '';}
        if ($data['remove_signature'] == 'on') {$data['signature'] = '';}

        $parameters = [
            'image_info' => [
                [
                    'type' => 'profile_picture',
                    'images' => $data->profile_picture,
                    'directory' => 'profile_pictures',
                    'input_field' => 'profile_picture',
                    'width' => '',
                    'height' => '',
                ],
                [
                    'type' => 'signature',
                    'images' => $data->signature,
                    'directory' => 'signatures',
                    'input_field' => 'signature',
                    'width' => '',
                    'height' => '',
                ],
            ],
        ];

        return $this->employee->update($employee->id,$data,$parameters);
    }

    public function destroy(Employee $employee){
        return $this->employee->delete($employee->id);
    }

    public function restore($id){
        return $this->employee->restore($id);
    }

    public function forceDelete($id){
        return $this->employee->forceDelete($id);
    }

}
