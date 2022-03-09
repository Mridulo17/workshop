<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductPartRequest;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ModelInterface;
use App\Interfaces\ProductPartInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\TypeInterface;
use App\Interfaces\VariantTypeInterface;
use App\Interfaces\VariantInterface;
Use App\Models\ProductPart;
use Brian2694\Toastr\Facades\Toastr;

class ProductPartController extends Controller
{
    protected $product_part;
    protected $variant_type;
    protected $variant;
    protected $product;
    protected $model;
    protected $type;
    protected $category;

    public function __construct(ProductPartInterface $product_part, VariantTypeInterface $variant_type,
                                VariantInterface $variant, ProductInterface $product, ModelInterface $model,
                                TypeInterface $type, CategoryInterface $category)
    {
        $this->product_part = $product_part;
        $this->variant_type = $variant_type;
        $this->variant = $variant;
        $this->product = $product;
        $this->model = $model;
        $this->type = $type;
        $this->category = $category;
        $this->middleware('auth');
    }

    protected function path(string $link){
        return "admin.product_part.{$link}";
    }

    public function index()
    {
        if(request()->ajax()){
            $datatable = $this->product_part->datatable(['type','category','brand','model','product_part_variants','product_part_products'],'false');

            $datatable->addColumn('variation', function($data){
                $variation = '';
                foreach ($data->product_part_variants as $product_part_variant){
                    $variation.= $product_part_variant->variant->bn_name.'('.@$product_part_variant->variant_type->bn_name.')'.'<br>';
                }
                return $variation;
            });

            return $datatable->rawColumns(['action','status','variation'])
                ->make(true);
        }else{
            return view($this->path('index'));
        }
    }

    public function deletedListIndex()
    {
        if (request()->ajax()){
            $datatable = $this->product_part->deletedDatatable(['type','category','brand','model','product_part_variants','product_part_products'],'false');

            $datatable->addColumn('variation', function($data){
                $variation = '';
                foreach ($data->product_part_variants as $product_part_variant){
                    $variation.= $product_part_variant->variant->bn_name.'('.@$product_part_variant->variant_type->bn_name.')'.'<br>';
                }
                return $variation;
            });

            return $datatable->rawColumns(['action','status','variation'])
                ->make(true);
        }
    }

    public function create()
    {
        $data = $this->product_part->commonData();
        return view($this->path('create'),$data);
    }

    public function store(ProductPartRequest $request)
    {
        $data = $request;
        $tracking_parameter = [
            'prefix' => 'pp'/*.$request->type_id*/
        ];
        $data['tracking_no'] = CommonHelper::trackingNumber(ProductPart::class,$tracking_parameter);
        $data['entry_date'] = date('Y-m-d',strtotime($request->entry_date)).' '.date('h:i a');
        $data['stock_check'] = ($data['stock_check'] == 'on') ? '1' : '0';
        $data['scrapable'] = ($data['scrapable'] == 'on') ? '1' : '0';

        /*$products = [];
        if($data->product_part_products != null){
            foreach ($data->product_part_products as $key => $value){
                $products[$key]['product_id'] = $value;
            }
        }
        $data->product_part_products = $products;*/

        $models = [];
        if($data->product_part_models != null){
            foreach ($data->product_part_models as $key => $value){
                $models[$key]['model_id'] = $value;
            }
        }

        $data->product_part_models = $models;

        $create_parameters = [
            'create_many' => [
                [
                    'relation' => 'product_part_models',
                    'data' => $models
                ],
                [
                    'relation' => 'product_part_variants',
                    'data' => $data->product_part_variants
                ],
            ],
            'image_info' => [
                [
                    'type' => 'image',
                    'images' => $data->images,
                    'directory' => 'product_part',
                    'width' => '',
                    'height' => '',
                ],
            ]
        ];

        $product_part = $this->product_part->create($data,$create_parameters);
        Toastr::success(trans('common.created',['model' => trans('product_part.product_part')]),trans('common.success'));
        return $product_part;
    }

    public function show(ProductPart $product_part)
    {
        //
    }

    public function edit(ProductPart $product_part)
    {
        $data = $this->product_part->commonData($product_part);
        $data['product_part'] = ProductPart::with('product_part_variants','product_part_variants.variants')->find($product_part->id);
        /*$data['product_part_products'] = $product_part->product_part_products->map(function($item) {
            return $item->product_id;
        });*/

        $data['product_part_models'] = $product_part->product_part_models->map(function($item) {
            return $item->model_id;
        });

        return view($this->path('edit'))->with($data);
    }

    public function update(ProductPartRequest $request, ProductPart $product_part)
    {
        $data = $request;
        $data['stock_check'] = ($data['stock_check'] == 'on') ? '1' : '0';
        $data['scrapable'] = ($data['scrapable'] == 'on') ? '1' : '0';
        if ($data['remove_image'] == 'on') {
            $data['image'] = '';
        };

        /*$products = [];
        if($data->product_part_products != null){
            foreach ($data->product_part_products as $key => $value){
                $products[$key]['product_id'] = $value;
            }
        }
        $data->product_part_products = $products;*/

        $models = [];
        if($data->product_part_models != null){
            foreach ($data->product_part_models as $key => $value){
                $models[$key]['model_id'] = $value;
            }
        }
        $data->product_part_models = $models;

        $update_parameters = [
            'create_many' => [
                [
                    'relation' => 'product_part_models',
                    'data' => $models
                ],
                [
                    'relation' => 'product_part_variants',
                    'data' => $data->product_part_variants
                ],
            ],
            'image_info' => [
                [
                    'type' => 'image',
                    'images' => $data->images,
                    'directory' => 'product_part',
                    'width' => '',
                    'height' => '',
                ],
            ]
        ];

        $product_part = $this->product_part->update($product_part->id,$data,$update_parameters);
        Toastr::success(trans('common.updated',['model' => trans('product_part.product_part')]),trans('common.success'));
        return $product_part;
    }

    public function destroy(ProductPart $product_part)
    {
        return $this->product_part->delete($product_part->id);
    }

    public function restore($id){
        return $this->product_part->restore($id);
    }

    public function forceDelete($id){
        return $this->product_part->forceDelete($id);
    }
}
