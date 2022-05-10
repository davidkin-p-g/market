<?php

namespace App\Http\Controllers\buyer;

use App\Http\Controllers\Controller;
use App\Models\products;
use App\Models\categories;
use Illuminate\Http\Request;

class buyer_products_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $IdCategories = null)
    {
        if ($IdCategories != null) {
            $ch_id = array();
            return view('buyer.products.index', [
                'categ' => categories::with('children')->where('IdParent', '0')->get(),
                'delimiter' => '&#149',
                'products' => products::with('products_categoties_name')->whereIn('IdCategories', categories::get_children_id($IdCategories, $ch_id))->where('isDelete', '0')->where('ProdPublished', 'on')->get(),
                'Categories' => categories::where('id', $IdCategories)->select('id', 'Categories')->first()


            ]);
//            return view('buyer.products.test', [
//                    'test' => $IdCategories
//            ]);

        }
        else
        {
            return view('buyer.products.index', [
                'categ' => categories::with('children')->where('IdParent', '0')->get(),
                'delimiter'  => '&#149',
                'products' => products::where('isDelete', '0')->where('ProdPublished', 'on')->get(),
            ]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(int $IdCategories)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products)
    {
        //
    }
}
