<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\products;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class products_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seller.products.index', [
            'categories' => categories::with('children')->where('IdParent', '0')->get(),
            'delimiter'  => '&#149'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( int $IdCategories, $product_id = null)
    {
        $ch_id = array();
        return view('seller.products.create', [
            'categ' => categories::with('children')->where('IdParent', '0')->get(),
            'delimiter'  => '&#149',
            'products' => products::with('products_categoties_name')->whereIn('IdCategories',categories::get_children_id($IdCategories,$ch_id) )->where('isDelete', '0')->get(),
            'Categor' => categories::where('id', $IdCategories)->select('id', 'Categories')->first(),
            'product_id' => $product_id,
            'categories' => categories::class::get()


        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $IdCategories)
    {
        products::create($request->all());
        return redirect()->route('products.create',['IdCategories' => $IdCategories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $IdCategories, int $product_id)
    {
        $product = products::find($product_id);
        $product->ProdName = $request->input('ProdName');
        $product->ProdCost = $request->input('ProdCost');
        $product->ProdCount = $request->input('ProdCount');
        $product->ProdPublished = $request->input('ProdPublished');
        $product->IdCategories = $request->input('IdCategories');
        $product->save();
        return redirect()->route('products.create',['IdCategories' => $IdCategories]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $IdCategories, int $product_id)
    {
        $product = products::find($product_id);
        $product->isDelete = 1;
        $product->save();
        return redirect()->route('products.create',['IdCategories' => $IdCategories]);
    }
}
