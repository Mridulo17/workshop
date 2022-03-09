<?php

namespace App\Http\Controllers\Common;

use App\Helpers\HtmlHelper;
use App\Http\Controllers\Controller;
use App\Interfaces\DriverAssignInterface;
use App\Interfaces\DriverInterface;
use App\Interfaces\ModelInterface;
use App\Interfaces\ProductPartInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\VariantInterface;
use App\Models\Content;
use App\Models\Division;
use App\Models\InspectionReport;
use App\Models\StockReceive;
use App\Models\DriverAssign;
use App\Models\Employee;
use App\Models\Product;
use App\Models\ProductPart;
use App\Models\StockReceiveItem;
use App\Models\User;
use App\Models\District;
use App\Models\FireStation;
use App\Models\Thana;
use App\Models\Workshop;
use App\Models\WorkshopOrder;
use App\Repositories\CategoryRepository;
use App\Repositories\FireStationRepository;
use App\Repositories\WorkshopRepository;
use App\Rules\LocalizedNumber;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    protected $variant;
    protected $product;
    protected $product_part;
    protected $model;
    protected $driver;
    protected $driver_assign;
    protected $category;
    protected $workshop;
    protected $fire_station;

    public function __construct(
        VariantInterface      $variant,
        ModelInterface        $model,
        ProductInterface      $product,
        ProductPartInterface $product_part,
        DriverInterface       $driver,
        DriverAssignInterface $driver_assign,
        CategoryRepository    $category,
        WorkshopRepository    $workshop,
        FireStationRepository $fire_station
    ){
        $this->variant = $variant;
        $this->product = $product;
        $this->product_part = $product_part;
        $this->model = $model;
        $this->driver = $driver;
        $this->driver_assign = $driver_assign;
        $this->category = $category;
        $this->workshop = $workshop;
        $this->fire_station = $fire_station;
    }

    public function GetDistrict(){
        $district = District::query()->where('division_id', request('division_id'))->where('status','Active')->get();
        return $district;
    }

    public function GetThana(){
        $thana = Thana::query()->where('district_id', request('district_id'))->where('status','Active')->get();
        return $thana;
    }

    public function contact()
    {
        $data['content'] = Content::query()->where('name','contact')->first();
        return view('guest.contact.show')->with($data);
    }

    public function GetDistrictFromDivision(){
        return District::query()->where('division_id', request('division_id'))->where('status','Active')->pluck('bn_name','id');
    }

    public function GetFireStationFromDistrict(){
        return FireStation::query()->where('district_id', request('district_id'))->where('status','Active')->get();
    }

    public function GetFireStationFromCode(){
        return FireStation::query()
            ->where('code', request('code'))
            ->where('status','Active')
            ->firstOrFail();
    }

    public function GetWorkshopFromDivision(){
        return Workshop::query()
            ->where('division_id', request('division_id'))
            ->where('status','Active')
            ->firstOrFail();
    }

    public function GetEmployee(){
        return Employee::query()->findOrFail(request('id'));
    }

    public function GetEmployeeFromPin(){
        return Employee::query()
            ->where('old_pin',request('pin'))
            ->orWhere('new_pin',request('pin'))
            ->firstOrFail();
    }

    public function GetUserDataFromOffice(){
        $office_id = request('office_id');
        $users = User::query()->with('division','district','fireStation','designation')->where('office_id',$office_id)->get();
        return $users;
    }

    public function GetMemberFromDistrictAndOffice(){
        $district_id = request('district_id');
        $office_id = request('office_id');
        $users = User::query()->with('designation')->where('office_id',$office_id)->where('district_id',$district_id)->get();
        return $users;
    }

    public function NumberValidation(Request $request){
        $request->validate([
            'input_number' => [new LocalizedNumber],
        ]);

        return true;
    }

    public function GetDistricts(Request $request){
       $districts = District::query()->where('division_id',$request->key)->pluck('bn_name','id');
       $data = HtmlHelper::dropdownOptions($districts);
       return $data['options'];
    }

    public function GetFireStations(Request $request){
       $fire_stations = FireStation::query()->where('district_id',$request->key)->pluck('bn_name','id');
       $data = HtmlHelper::dropdownOptions($fire_stations);
       return $data['options'];
    }

    public function GetFireStationFromThana(Request $request){
       $fire_stations = FireStation::query()->where('thana_id',$request->key)->pluck('bn_name','id');
       $data = HtmlHelper::dropdownOptions($fire_stations);
       return $data['options'];
    }

    public function GetThanas(Request $request){
       $thanas = Thana::query()->where('district_id',$request->key)->pluck('bn_name','id');
       $data = HtmlHelper::dropdownOptions($thanas);
       return $data['options'];
    }

    public function GetVariants(Request $request){
       $variants = $this->variant->pluck(['variant_type_id'=> $request->key]);
       $data = HtmlHelper::dropdownOptions($variants);
       return $data['options'];
    }

    public function GetModels(Request $request){
        $models = $this->model->pluck(['brand_id'=> $request->key]);
        $data = HtmlHelper::dropdownOptions($models);
        return $data['options'];
    }

    public function getProductPartByModel(Request $request){
        $data = '';
            $selectProductPartRawParams = [
                'columns' => "id, tracking_no",
                'pluck' => [
                    'key' => 'tracking_no',
                    'value' => 'id'
                ],
                'where' => [
                    'model_id'=> $request->key
                ],
            ];
            $data = $this->product_part->selectRawPluck($selectProductPartRawParams);

        $data = HtmlHelper::dropdownOptions($data);
        return $data['options'];
    }

    public function GetProducts(Request $request){
        $selectProductRawParamsWhereModel = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'where' => [
                'model_id'=> @$request->id
            ],
        ];
        $selectProductRawParamsWhereModelAndCategory = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'where' => [
                'model_id'=> @$request->id,
                'category_id' => @$request->filter
            ],
        ];
        if ($request->filter){
            $products = $this->product->selectRawPluck($selectProductRawParamsWhereModelAndCategory);
        } else {
            $products = $this->product->selectRawPluck($selectProductRawParamsWhereModel);
        }
        $data = HtmlHelper::dropdownOptions($products);
        return $data['options'];
    }

    public function FindProduct(Request $request){
        return Product::query()->with('type','category','brand','model')->findOrFail($request->id);
    }

    public function FindFireStation(Request $request){
        $fire_station = FireStation::query()->with('division', 'district', 'thana')->findOrFail($request->id);
        $workshop = Workshop::where('division_id',$fire_station->division->id)->first();
        return $data = [
            'fire_station' => $fire_station,
            'workshop' => $workshop,
        ];
    }

    public function FindWorkshopOrder(Request $request){
        return WorkshopOrder::query()->with('product','product.type','product.category','product.brand','product.model','product.fire_station','workshop','faults')->findOrFail
        ($request->id);
    }

    public function FindInspectionReport(Request $request){

         return InspectionReport::query()->with('workshopOrder',
                                                'workshopOrder.product',
                                                        'workshopOrder.product.type',
                                                        'workshopOrder.product.category',
                                                        'workshopOrder.product.model',
                                                        'workshopOrder.product.brand',
                                                        'workshopOrder.product.brand',
                                                        'workshopOrder.product.fire_station',
                                                        'workshopOrder.workshop',
                                                        'demands',
                                                        'demands.productPart'
                                                )->findOrFail
                                                ($request->id);
//         dd($pp);
//        return $pp;
    }

    public function GetDrivers(Request $request){
        $driver_assigns = $this->driver_assign->get(['product_id' => $request->key]);
        $options = '<option value="">'.trans("common.select").'</option>';
        foreach ($driver_assigns as $value){
            $employee = $value->driver->employee;
            $options .= '<option value="'.$value->driver->id.'">'.$employee->bn_name.' ['.$employee->old_pin.'] ['.$employee->new_pin.']</option>';
        }
        return $options;
    }

    public function getItemQtyByType(Request $request){
        $data['total_qty'] = StockReceiveItem::query()->where('type',$request->type)
            ->where('itemable_id',$request->id)
            ->whereHas('stock_receive', function($q) use($request){
                $q->where('workshop_id', $request->workshop_id);
            })
            ->sum('received_qty');
        if($request->type == 'product'){
            $data['model'] = Product::class;
        }elseif($request->type == 'product_part'){
            $data['model'] = ProductPart::class;
        }
        return $data;
    }

    public function getCategoriesByType(Request $request){
        $categories = $this->category->pluck(['type_id'=> $request->key]);
        $data = HtmlHelper::dropdownOptions($categories);
        return $data['options'];
    }

    public function getFireStationsByWorkshop(Request $request){
        $workshop = $this->workshop->find($request->key);
        $fire_stations = $this->fire_station->pluck(['division_id'=> $workshop->division_id]);
        $data = HtmlHelper::dropdownOptions($fire_stations);
        return $data['options'];
    }

    public function getDivisionsByWorkshop(Request $request){
        $workshop = $this->workshop->find($request->id);
        $division_by_workshop = Division::find($workshop->division_id);
        return $division_by_workshop;
    }

}
