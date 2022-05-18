<?php

namespace App\Http\Controllers\offers;

use App\Http\Controllers\Controller;
use App\Models\chats;
use App\Models\offer;
use App\Models\products;
use App\Models\quotas;
use App\Models\quotas_items;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class offers_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();// получили пользователя
        $offers = new offer();
        if($user->Roles == 'Покупатель') {$offers = $offers->offers_buyer($user)->get();}
        if ($user->Roles == 'Поставщик') {$offers = $offers->offers_seller($user)->get();}
        return view('offers.index', ['offers' => $offers]);
    }

    public function quota($quota_id)
    {
        $user = auth()->user();// получили пользователя
        $offers = new offer();
        if($user->Roles == 'Покупатель') {$offers = $offers->offers_buyer($user)->where('quotas.id', $quota_id)->get();}
        if ($user->Roles == 'Поставщик') {$offers = $offers->offers_seller($user)->where('quotas.id', $quota_id)->get();}
        return view('offers.index', ['offers' => $offers]);
    }

    public function item($item_id)
    {
        $user = auth()->user();// получили пользователя
        $offers = new offer();
        if($user->Roles == 'Покупатель') {$offers = $offers->offers_buyer($user)->where('quotas_items.id', $item_id)->get();}
        if ($user->Roles == 'Поставщик') {$offers = $offers->offers_seller($user)->where('quotas_items.id', $item_id)->get();}
        return view('offers.index', ['offers' => $offers]);
    }

    public function product($product_id)
    {
        $user = auth()->user();// получили пользователя
        $offers = new offer();
        if($user->Roles == 'Покупатель') {$offers = $offers->offers_buyer($user)->where('products.id', $product_id)->get();}
        if ($user->Roles == 'Поставщик') {$offers = $offers->offers_seller($user)->where('products.id', $product_id)->get();}
        return view('offers.index', ['offers' => $offers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param    $id // id продукта
     * @return \Illuminate\Http\Response
     *
     */
    public function create(int $id, int $quota_id = null)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель') {

            if (isset($quota_id))
            {
                return view('offers.create_buyer', [
                    'quota' => quotas::where('id', $quota_id)->first(),
                    'items' => quotas_items::with('quotas_item_categoties_name')->where('QuotasId', $quota_id)->where('isDelete', 0)->get(),
                    'id' => $id,

                ]);

            }
            else {
                $q = new quotas();
                return view('offers.quotas_buyer', [
                    'quotas' => $q->quotas_buyer_pub($user->id),
                    'id' => $id,

                ]);
            }
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param    $id // id итема
     * @return \Illuminate\Http\Response
     *
     */
    public function create_post(int $id, int $IdCategories)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель') {

            return view('products.index');
        }
        if ($user->Roles == 'Поставщик')
        {
            $ch_id = array();
            return view('products.index', [
                'categ' => categories::with('children')->where('IdParent', '0')->get(),
                'delimiter' => '&#149',
                'products' => products::with('products_categoties_name')->whereIn('IdCategories', categories::get_children_id($IdCategories, $ch_id))->where('isDelete', '0')->where('ProdPublished', 'on')->get(),
                'Categories' => categories::where('id', $IdCategories)->select('id', 'Categories')->first(),
                'id' => $id


            ]);
        }
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(int $id, int $dop_id)
    {
        $user = auth()->user();// получили пользователя

        if($user->Roles == 'Покупатель')
        {
            $item = quotas_items::where('id',$dop_id)->first();

            return view('offers.add', [
                'quota' => quotas::where('id', $item->QuotasId)->first(),
                'item' => quotas_items::with('quotas_item_categoties_name')->where('id',$dop_id)->first(),
                'product' => products::with('products_categoties_name')->where('id', $id)->first(),

            ]);
        }
        if ($user->Roles == 'Поставщик')
        {
            $item = quotas_items::where('id',$id)->first();

            return view('offers.add', [
                'quota' => quotas::where('id', $item->QuotasId)->first(),
                'item' => quotas_items::with('quotas_item_categoties_name')->where('id',$id)->first(),
                'product' => products::with('products_categoties_name')->where('id', $dop_id)->first()

            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, quotas_items $item, products $product)
    {
        $user = auth()->user();// получили пользователя

            $data = $request->all();

            $data['ItemsId'] = $item->id;
            $data['ProductsId'] = $product->id;
            $data['SellerId'] = $product->SellerId;
            $b = quotas::where('id', $item->QuotasId)->first();
            $data['BuyerId'] = $b->BuyerId;


            offer::create($data);

        if($user->Roles == 'Покупатель') {
            return redirect()->route('products.index');
        }
        if ($user->Roles == 'Поставщик')
        {
            return redirect()->route('quotas.index');
        }
    }

    public function storechat(Request $request, int $offer_id)
    {
        $user = auth()->user();// получили пользователя
        $data = $request->all();
        $data['UserId'] = $user->id;
        $data['OfferId'] = $offer_id;

        chats::create($data);
        return redirect()->route('offers.edit',['offer_id'=> $offer_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(offer $offer)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель') {
            return view('home');
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $offer_id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $offer_id)
    {
        $user = auth()->user();// получили пользователя
        $offer = offer::where('id',$offer_id)->where('isDelete', 1)->first();
        $item = quotas_items::where('id',$offer->ItemsId)->first();
        $chat = new chats();
        $chat = $chat->chat_user($offer_id);

        return view('offers.add', [
            'quota' => quotas::where('id', $item->QuotasId)->first(),
            'item' => quotas_items::with('quotas_item_categoties_name')->where('id',$offer->ItemsId)->first(),
            'product' => products::with('products_categoties_name')->where('id', $offer->ProductsId)->first(),
            'offer' => $offer,
            'chats' => $chat


        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $offer_id)
    {
        $user = auth()->user();// получили пользователя
        $offer = offer::find($offer_id);
        if($user->Roles == 'Покупатель') {

            $offer->OfferBuyerCount = $request->input('OfferBuyerCount');
            $offer->OfferBuyerCost = $request->input('OfferBuyerCost');
            if ($offer->OfferBuyerCount == $offer->OfferSellerCount &&  $offer->OfferBuyerCost == $offer->OfferSellerCost)
            {
                if ($request->input('BuyerPublished') == 'on')
                $offer-> BuyerPublished = 1;
            }

        }
        if ($user->Roles == 'Поставщик')
        {
            $offer->OfferSellerCount = $request->input('OfferSellerCount');
            $offer->OfferSellerCost = $request->input('OfferSellerCost');
            if ($offer->OfferBuyerCount == $offer->OfferSellerCount &&  $offer->OfferBuyerCost == $offer->OfferSellerCost)
            {
                if ($request->input('SellerPublished') == 'on')
                $offer->SellerPublished = 1;
            }

        }

        if( $offer->BuyerPublished == 1 && $offer-> SellerPublished == 1 )
        {
            $offer->PublishedDate = date('Y-m-d ');
        }




        $offer->save();
        return redirect()->route('offers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $offer_id)
    {
        $user = auth()->user();// получили пользователя
        $offer = offer::find($offer_id);
        // каскадное удаление итемов
        $offer->isDelete = 1;
        $offer->save();
        return redirect()->route('offers.index');
    }
}
