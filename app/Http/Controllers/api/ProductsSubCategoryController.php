<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsSubCategoryRequest;
use App\Http\Resources\ProductsSubCategoryResource;
use App\Models\ProductsSubCategory;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\JsonResource;

class ProductsSubCategoryController extends Controller
{

    private function filters($model, $filters)
        {
            return $model->when(!empty($filters["category_id"]), function ($query) use ($filters) {
            return $query->where("category_id" , "LIKE", "%" . $filters["category_id"] . "%");
        })
->when(!empty($filters["created_at"]), function ($query) use ($filters) {
            return $query->where("created_at" , "LIKE", "%" . $filters["created_at"] . "%");
        })
->when(!empty($filters["description"]), function ($query) use ($filters) {
            return $query->where("description" , "LIKE", "%" . $filters["description"] . "%");
        })
->when(!empty($filters["is_active"]), function ($query) use ($filters) {
            return $query->where("is_active" , "LIKE", "%" . $filters["is_active"] . "%");
        })
->when(!empty($filters["sub_category_id"]), function ($query) use ($filters) {
            return $query->where("sub_category_id" , "LIKE", "%" . $filters["sub_category_id"] . "%");
        })
->when(!empty($filters["sub_category_name"]), function ($query) use ($filters) {
            return $query->where("sub_category_name" , "LIKE", "%" . $filters["sub_category_name"] . "%");
        })
->when(!empty($filters["updated_at"]), function ($query) use ($filters) {
            return $query->where("updated_at" , "LIKE", "%" . $filters["updated_at"] . "%");
        })
;
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index(Request $request) : JsonResource
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
            $productsSubCategory = ProductsSubCategory::orderBy($sortBy, ($request->sortDesc == 'false') ? 'asc' : 'desc');
            return ProductsSubCategoryResource::collection($this->filters($productsSubCategory, $filters)->paginate($page));
        }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ProductsSubCategoryRequest $request)
    {
        return new ProductsSubCategoryResource(ProductsSubCategory::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\ProductsSubCategory $productsSubCategory
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ProductsSubCategory $productsSubCategory)
    {
        return new ProductsSubCategoryResource($productsSubCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\ProductsSubCategory $productsSubCategory
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProductsSubCategoryRequest $request, ProductsSubCategory $productsSubCategory)
    {
        $productsSubCategory->update($request->validated());
        return new ProductsSubCategoryResource($productsSubCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\ProductsSubCategory $productsSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsSubCategory $productsSubCategory)
    {
        $productsSubCategory->delete();
    }
}
