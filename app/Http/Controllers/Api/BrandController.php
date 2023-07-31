<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public $successStatus = 200;
    public $createStatus = 201;
    public $badRequest = 400;
    public $accessForbidden = 403;
    public $serverErrorStatus = 500;
    public $notFoundStatus = 404;
    public $tokenString = 'm';

    public function getAllBrandWithProductCount()
    {
        $brands = DB::select('SELECT brands.id, brands.name, count(products.brand_id) as total from brands LEFT JOIN products on brands.id = products.brand_id where products.is_draft = 0 group BY brands.id');
        return response()->json(['getAllBrandWithProductCount'=>$brands], $this->successStatus);
    }

    public function getSingleBrandWithAllProduct($id)
    {
        $singleBrandProduct = DB::table('products')->select('products.id', 'products.name', 'products.price', 'users.first_name', 'users.last_name', 'product_pictures.picture', 'countries.flag', DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('product_ratings.product_id')
            ->leftjoin('users', 'products.user_id', '=', 'users.id')
            ->leftjoin('product_pictures', 'products.id', '=', 'product_pictures.product_id')
            ->leftJoin('countries', 'products.country_id', '=', 'countries.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->where('products.brand_id', '=', $id)
            ->where('products.is_draft', '=', 0)
            ->get();
        return response()->json(['getSingleBrandWithAllProduct'=>$singleBrandProduct], $this->successStatus);
    }

}
