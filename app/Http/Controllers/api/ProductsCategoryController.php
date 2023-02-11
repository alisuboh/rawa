<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsCategoryRequest;
use App\Http\Resources\ProductsCategoryResource;
use App\Models\ProductsCategory;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\JsonResource;

class ProductsCategoryController extends Controller
{

    private function filters($model, $filters)
    {
        return $model->when(!empty($filters["category_id"]), function ($query) use ($filters) {
            return $query->where("category_id", "LIKE", "%" . $filters["category_id"] . "%");
        })
            ->when(!empty($filters["category_name"]), function ($query) use ($filters) {
                return $query->where("category_name", "LIKE", "%" . $filters["category_name"] . "%");
            })
            ->when(!empty($filters["category_type"]), function ($query) use ($filters) {
                return $query->where("category_type", "LIKE", "%" . $filters["category_type"] . "%");
            })
            ->when(!empty($filters["created_at"]), function ($query) use ($filters) {
                return $query->where("created_at", "LIKE", "%" . $filters["created_at"] . "%");
            })
            ->when(!empty($filters["description"]), function ($query) use ($filters) {
                return $query->where("description", "LIKE", "%" . $filters["description"] . "%");
            })
            ->when(!empty($filters["is_active"]), function ($query) use ($filters) {
                return $query->where("is_active", "LIKE", "%" . $filters["is_active"] . "%");
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
        $sortBy = 'id';
        $page = 1;
        if ($request->has('size')) {
            $page = $request->get('size');
        }

        if (!empty($request->sortBy)) {
            $sortBy = $request->sortBy;
        }
        $filters = json_decode($request->get('filter'), true);
        $productsCategory = ProductsCategory::orderBy($sortBy, ($request->sortDesc == 'false') ? 'asc' : 'desc');
        return ProductsCategoryResource::collection($this->filters($productsCategory, $filters)->paginate($page));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ProductsCategoryRequest $request)
    {
        return new ProductsCategoryResource(ProductsCategory::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\ProductsCategory $productsCategory
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ProductsCategory $productsCategory)
    {
        return new ProductsCategoryResource($productsCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\ProductsCategory $productsCategory
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProductsCategoryRequest $request, ProductsCategory $productsCategory)
    {
        $productsCategory->update($request->validated());
        return new ProductsCategoryResource($productsCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\ProductsCategory $productsCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsCategory $productsCategory)
    {
        $productsCategory->delete();
    }
}
