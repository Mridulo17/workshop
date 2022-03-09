<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Workshop;
use App\Models\Requisition;
use App\Helpers\ModalHelper;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use App\Models\WorkshopOrder;
use App\Models\InspectionReport;
use App\Http\Controllers\Controller;
use App\Interfaces\RequisitionInterface;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use App\Http\Requests\Admin\RequisitionRequest;
use App\Models\Demand;
use App\Models\ProductPart;

class RequisitionController extends Controller
{

    protected $requisition;

    public function __construct(RequisitionInterface $requisition){
        $this->requisition = $requisition;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.requisition.{$link}";
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->requisition->commonData();
        $this->ReceiveRequisitionFormDataFromFstore();
        return view($this->path('create'))->with($data);
    }

    // Receive requisition form data from fstore
    public function ReceiveRequisitionFormDataFromFstore()
    {
        return $this->requisition->ReceiveRequisitionFormDataFromFstore();
    }

    public function getCategoryByTypeIdUrl($id)
    {
        // dd($id);
        return $id;
        // return $this->requisition->ReceiveRequisitionFormDataFromFstore();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProductByInspectionTrackingNumber(RequisitionRequest $request) {
        $demands = Demand::where('inspection_report_id', $request->inspection_tracking_number)->get();
        $product_parts=[];
        foreach ($demands as $demand) {
            $product_part = ProductPart::with('type', 'category', 'brand', 'model', 'fireStation')->find($demand->product_part_id);
            $product_parts[] = $product_part;
        }
        return $product_parts;
    }
}
