<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class products extends Model
{
    protected $guarded = ['id'];

    public function products_categoties_name() {
        return $this->hasMany(categories::class, 'id', 'IdCategories')->select('id', 'Categories');
    }

    public function products_offers_seller($user, $IdCategories = null, $ch_id = null) {
        $user_id = $user->id;
        if ($IdCategories == null) {
            $products = DB::table('products')
                ->select('products.*',
                    'categories.Categories',
                    DB::raw('count(offers.id) as offers_count')
                )
                ->where('products.isDelete', 0)
                ->where('products.ProdPublished', 'on')

                ->join('categories', 'categories.id', '=', 'products.IdCategories')

                ->leftJoin('offers', 'products.id', '=', 'offers.ProductsId')
                ->where(function($query) use ($user_id)
                {
                    $query->where('offers.isDelete', 0)
                        ->where('offers.SellerId',$user_id)
                        ->orWhereNull('offers.SellerId');
                })

                ->groupBy('products.id')
                ->get();
        }
        else
        {
            $products = DB::table('products')
                ->select('products.*',
                    'categories.Categories',
                    DB::raw('count(offers.id) as offers_count')
                )
                ->where('products.isDelete', 0)
                ->where('products.ProdPublished', 'on')

                ->join('categories', 'categories.id', '=', 'products.IdCategories')
                ->whereIn('products.IdCategories', categories::get_children_id($IdCategories, $ch_id))

                ->leftJoin('offers', 'products.id', '=', 'offers.ProductsId')
                ->where(function($query) use ($user_id)
                {
                    $query->where('offers.isDelete', 0)
                        ->where('offers.SellerId',$user_id)
                        ->orWhereNull('offers.SellerId');
                })

                ->groupBy('products.id')
                ->get();
        }

        return $products;
    }

    public function products_offers_buyer($user, $IdCategories = null, $ch_id = null) {
        $user_id = $user->id;
        if ($IdCategories == null) {
            $products = DB::table('products')
                ->select('products.*',
                    'categories.Categories',
                    DB::raw('count(offers.id) as offers_count')
                )
                ->where('products.isDelete', 0)
                ->where('products.ProdPublished', 'on')

                ->join('categories', 'categories.id', '=', 'products.IdCategories')

                ->leftJoin('offers', 'products.id', '=', 'offers.ProductsId')
                ->where(function($query) use ($user_id)
                {
                    $query->where('offers.isDelete', 0)
                        ->where('offers.BuyerId',$user_id)
                        ->orWhereNull('offers.BuyerId');
                })

                ->groupBy('products.id')
                ->get();
        }
        else
        {
            $products = DB::table('products')
                ->select('products.*',
                    'categories.Categories',
                    DB::raw('count(offers.id) as offers_count')
                )

                ->where('products.isDelete', 0)
                ->where('products.ProdPublished', 'on')

                ->join('categories', 'categories.id', '=', 'products.IdCategories')
                ->whereIn('products.IdCategories', categories::get_children_id($IdCategories, $ch_id))

                ->leftJoin('offers', 'products.id', '=', 'offers.ProductsId')
                ->where(function($query) use ($user_id)
                {
                    $query->where('offers.isDelete', 0)
                        ->where('offers.BuyerId',$user_id)
                        ->orWhereNull('offers.BuyerId');
                })

                ->groupBy('products.id')
                ->get();
        }

        return $products;
    }
}
