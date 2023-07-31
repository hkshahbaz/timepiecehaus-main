<?php

namespace App\Imports;

use App\Brand;
use App\Condition;
use App\DeliveryScope;
use App\Product;
use App\ProductCategory;
use App\ProductType;
use App\User;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithStartRow, WithValidation, SkipsOnFailure
{
    use Importable;
    
    private $failures = [];

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        $data = [];
        $user = User::whereEmail($row[0])->first();
        if ($user) {
            if(auth()->id() != $user->id){
                return NULL;
            }
            if ($row[1] == '' || $row[1] == NULL) {
                return NULL;
            }
            $data['name'] = $row[1];

            if ($row[2] == '' || $row[2] == NULL) {
                return NULL;
            }
            $data['description'] = $row[2];

            if ($row[3] == '' || $row[3] == NULL) {
                return NULL;
            }
            $data['price'] = $row[3];

            if ($row[4] == '' || $row[4] == NULL) {
                return NULL;
            }
            $data['shipping_cost'] = $row[4];

            if ($row[5] != '' && $row[5] != NULL) {
                $productType = ProductType::whereName($row[5])->whereStatusId(1)->first();
                if ($productType) {
                    $data['product_type_id'] = $productType->id;
                }
            } else {
                return NULL;
            }

            if ($row[6] != '' && $row[6] != NULL) {
                $productCategory = ProductCategory::whereName($row[6])->whereStatusId(1)->first();
                if ($productCategory) {
                    $data['product_category_id'] = $productCategory->id;
                }
            } else {
                return NULL;
            }

            if ($row[7] != '' && $row[7] != NULL) {
                $brand = Brand::whereName($row[7])->whereStatusId(1)->first();
                if ($brand) {
                    $data['brand_id'] = $brand->id;
                }
            } else {
                return NULL;
            }

            if ($row[8] != '' && $row[8] != NULL) {
                $condition = Condition::whereName($row[8])->whereStatusId(1)->first();
                if ($condition) {
                    $data['condition_id'] = $condition->id;
                }
            } else {
                return NULL;
            }

            if ($row[9] != '' && $row[9] != NULL) {
                $deliveryScope = DeliveryScope::whereName($row[9])->whereStatusId(1)->first();
                if ($deliveryScope) {
                    $data['delivery_scope_id'] = $deliveryScope->id;
                }
            } else {
                return NULL;
            }

            if ($row[10] != '' && $row[10] != NULL) {
                $data['modal'] = $row[10];
            } else {
                return NULL;
            }

            if ($row[11] != '' && $row[11] != NULL) {
                $data['gender'] = $row[11];
            } else {
                return NULL;
            }

            $data['year_of_production'] = $row[12];
            if ($row[12] != '' && $row[12] != NULL) {
                $data['approximation_unknown'] = 1;
            } else {
                $data['approximation_unknown'] = 0;
            }

            $data['status_id'] = 11;
            $data['is_draft'] = 1;
            $data['user_id'] = $user->id;
            $data['country_id'] = $user->country_id;
            $product = Product::create($data);
//            dd($product);
            return $product;
        }
    }

    public function startRow(): int
    {
        return 2;
    }
    
    public function rules(): array
    {
        return [
            '0' => function ($attribute, $value, $fail){
                $user = User::where('email',$value)->first();
                if($value != '' && !$user){
                    $fail('User not registred');
                }
            }
        ];
    }
    
    public function onFailure(Failure... $failures) 
    {
         $this->failures = $failures;
    
    }
    
    public function failures()
    {
        return $this->failures;
    }
}
