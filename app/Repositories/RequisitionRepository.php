<?php
namespace App\Repositories;

use App\Helpers\ENTOBN;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\LubricantRecord;
use App\Interfaces\RequisitionInterface;
use App\Models\InspectionReport;
use App\Models\Product;
use App\Models\Requisition;
use Illuminate\Database\Eloquent\Collection;
class RequisitionRepository extends BaseRepository implements RequisitionInterface
{
    protected $type;
    protected $category;
    protected $brand;
    protected $product_model;

    public function __construct(
        Requisition $model,
        TypeRepository $type,
        CategoryRepository $category,
        BrandRepository $brand,
        ModelRepository $product_model
    )
    {
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->brand = $brand;
        $this->product_model = $product_model;
    }


    public function ReceiveRequisitionFormDataFromFstore()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => config('app.fstore_url')]);
        $url = 'api/receive-request-from-workshop-for-requisition-info';
        $token = config('app.fstore_token');
        $data = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ],
        ];

        $response = $client->post($url, $data);
        $requisition_data = json_decode($response->getBody()->getContents());
        // dd($requisition_data->categories);
        return $requisition_data;
    }

    public function commonData($requisition = null)
    {
        $data = [
            'inspection_tracking_numbers' => InspectionReport::pluck('tracking_no', 'id'),
            'requisition_data' => $this->ReceiveRequisitionFormDataFromFstore(),

            'requisition' => $requisition,
            'brands' => $this->brand->pluck(),
            'models' =>$this->product_model->pluck(),
            'products' => [1,2,3],
            'product_registration_numbers' => [1,2,3],
            'product_parts' => [1,2,3],
            'types' => $this->type->pluck(),
            'categories' => $this->category->pluck(),
            'entry_types' => LubricantRecord::entry_types(),
        ];
        return $data;
    }
}
