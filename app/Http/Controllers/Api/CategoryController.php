<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public $successStatus = 200;
    public $createStatus = 201;
    public $badRequest = 400;
    public $accessForbidden = 403;
    public $serverErrorStatus = 500;
    public $notFoundStatus = 404;
    public $tokenString = 'm';

    public function topCategory()
    {
        $topCategories = ProductCategory::select('id', 'name', 'picture')->wherein('id', array(4, 10))->get();
        return response()->json(['topCategory'=>$topCategories], $this->successStatus);
    }

    public function getAllCategoryWithProductCount()
    {
        $categories = DB::select('SELECT product_categories.id, product_categories.name, count(products.product_category_id) as total from product_categories LEFT JOIN products on product_categories.id = products.product_category_id where products.is_draft = 0 group BY product_categories.id');

        return response()->json(['getAllCategoryWithProductCount' => $categories], $this->successStatus);
    }

    public function getSingleCategoryWithAllProduct($id)
    {
        $categories = DB::table('products')->select('products.id', 'products.name', 'products.price', 'users.first_name', 'users.last_name', 'product_pictures.picture', 'countries.flag', DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('product_ratings.product_id')
            ->leftjoin('users', 'products.user_id', '=', 'users.id')
            ->leftjoin('product_pictures', 'products.id', '=', 'product_pictures.product_id')
            ->leftJoin('countries', 'products.country_id', '=', 'countries.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->where('products.product_category_id', '=', $id)
            ->where('products.is_draft', '=', 0)
            ->get();
        return response()->json(['getSingleCategoryWithAllProduct'=>$categories], $this->successStatus);
    }

}
