<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{

    private function filters($model, $filters)
    {
        return $model->when(!empty($filters["category_id"]), function ($query) use ($filters) {
            return $query->where("category_id", "LIKE", "%" . $filters["category_id"] . "%");
        })
            ->when(!empty($filters["created_at"]), function ($query) use ($filters) {
                return $query->where("created_at", "LIKE", "%" . $filters["created_at"] . "%");
            })
            ->when(!empty($filters["icon_path"]), function ($query) use ($filters) {
                return $query->where("icon_path", "LIKE", "%" . $filters["icon_path"] . "%");
            })
            ->when(!empty($filters["picture"]), function ($query) use ($filters) {
                return $query->where("picture", "LIKE", "%" . $filters["picture"] . "%");
            })
            ->when(!empty($filters["product_code"]), function ($query) use ($filters) {
                return $query->where("product_code", "LIKE", "%" . $filters["product_code"] . "%");
            })
            ->when(!empty($filters["product_description"]), function ($query) use ($filters) {
                return $query->where("product_description", "LIKE", "%" . $filters["product_description"] . "%");
            })
            ->when(!empty($filters["product_id"]), function ($query) use ($filters) {
                return $query->where("product_id", "LIKE", "%" . $filters["product_id"] . "%");
            })
            ->when(!empty($filters["product_name"]), function ($query) use ($filters) {
                return $query->where("product_name", "LIKE", "%" . $filters["product_name"] . "%");
            })
            ->when(!empty($filters["size"]), function ($query) use ($filters) {
                return $query->where("size", "LIKE", "%" . $filters["size"] . "%");
            })
            ->when(!empty($filters["updated_at"]), function ($query) use ($filters) {
                return $query->where("updated_at", "LIKE", "%" . $filters["updated_at"] . "%");
            });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(Request $request): JsonResource
    {
        $sortBy = 'product_id';
        $page = 1;
        if ($request->has('size')) {
            $page = $request->get('size');
        }

        if (!empty($request->sortBy)) {
            $sortBy = $request->sortBy;
        }
        $filters = json_decode($request->get('filter'), true);
        $product = Product::orderBy($sortBy, ($request->sortDesc == 'false') ? 'asc' : 'desc');
        return ProductResource::collection($this->filters($product, $filters)->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ProductRequest $request)
    {
        return new ProductResource(Product::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\Product $product
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\Product $product
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
