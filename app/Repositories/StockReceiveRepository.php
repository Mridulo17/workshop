<?php


namespace App\Repositories;

use App\Interfaces\StockReceiveInterface;
use App\Helpers\MenuHelper;
use App\Models\StockReceive;
use App\Models\Product;

class StockReceiveRepository extends BaseRepository implements StockReceiveInterface
{
    protected $stock_receive;
    protected $workshop;
    protected $fire_station;
    protected $supplier;
    protected $item_model;
    protected $product;
    protected $product_part;

    public function __construct(
        StockReceive $model,
        WorkshopRepository $workshop,
        FireStationRepository $fire_station,
        SupplierRepository $supplier,
        ModelRepository $item_model,
        ProductRepository $product,
        ProductPartRepository $product_part
    )
    {
        $this->model = $model;
        $this->workshop = $workshop;
        $this->fire_station = $fire_station;
        $this->supplier = $supplier;
        $this->item_model = $item_model;
        $this->product = $product;
        $this->product_part = $product_part;
    }

    public function commonData($stock_receive = null)
    {
        $selectProductRawParams = [
          'columns' => "id, tracking_no",
          'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'],
            ];
        $selectProductPartRawParams = [
            'columns' => "id, tracking_no",
            'pluck' => [
                'key' => 'tracking_no',
                'value' => 'id'
            ],
            'where' => [
                'model_id'=> @$stock_receive->model_id
            ],
        ];
        $data = [
            'models' => $this->item_model->pluck(),
            'workshops' => $this->workshop->pluck(),
            'fire_stations' => $this->fire_station->pluck(),
            'suppliers' => $this->supplier->pluck(),
            'products' => $this->product->selectRawPluck($selectProductRawParams),
            'product_parts' => $this->product_part->selectRawPluck($selectProductPartRawParams),
        ];
        return $data;
    }
}
