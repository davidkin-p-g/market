<?php

namespace App\Http\Controllers\buyer;

use App\Http\Controllers\Controller;
use App\Models\quotas;
use App\Models\quotas_items;
use App\Models\categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class quotas_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();// получили пользователя
        $q = new quotas();
        if($user->Roles == 'Покупатель')
        {
            return view('quotas.index', [
                'quotas' => $q->quotas_buyer($user->id),
            ]);
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('quotas.index', [
                'quotas' => $q->quotas_seller($user->id)
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
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель')
        {
            return view('quotas.create', [
                'quotas'=> []
            ]);
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель')
        {
            $q = quotas::create($request->all());
            $id = $q->id;
            return redirect()->route('quotas.edit',['quota_id' => $id]);
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quotas  $quotas
     * @return \Illuminate\Http\Response
     */
    public function show(int $quota_id)
    {
        $user = auth()->user();// получили пользователя
        $q = new quotas();
        $i = new quotas_items();
        if($user->Roles == 'Покупатель') {
            return view('quotas.show', [
                'quotas' => $q->quota_by_id($quota_id),
                'items' => $i->items_buyer($user->id, $quota_id),
            ]);
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('quotas.show', [
                'quotas' => $q->quota_by_id($quota_id),
                'items' => $i->items_seller($user->id, $quota_id),
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quotas  $quotas
     * @return \Illuminate\Http\Response
     */
    public function edit(int $quota_id, int $item_id = null)
    {
        $q = new quotas();
        $i = new quotas_items();
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель')
        {
            if ( $item_id == null) {
                return view('quotas.edit', [
                    'quotas' => $q->quota_by_id($quota_id),
                    'items' => $i->items_buyer($user->id, $quota_id),
                    'categories' => categories::class::get(),// для всплывающего списка
                    'q' => $quota_id,
                    'quota_id' => $quota_id
                ]);
            }
            else
            {
                return view('quotas.edit', [
                    'quotas' => $q->quota_by_id($quota_id),
                    'items' => $i->items_buyer($user->id, $quota_id),
                    'categories' => categories::class::get(),// для всплывающего списка
                    'item_id' => $item_id,
                    'quota_id' => $quota_id
                ]);
            }

        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\quotas  $quotas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $quota_id)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель')
        {


            $quota = quotas::find($quota_id);
            $quota->Name = $request->input('Name');
            $quota->Text = $request->input('Text');
            $quota->QRealizationDate = $request->input('QRealizationDate');

            $items = quotas_items::where('QuotasId',$quota_id)->get();
            if(isset($items)) {
                if($request->input('QPublished') == 'on') {
                    $quota->QPublishedDate = date('Y-m-d ');
                    $quota->QPublished = $request->input('QPublished');
                }
            }
            // иначе на бы ощибочку вывести
            //quotas::where('quotas_id', $quota)->first()->update($request->all());
            $quota->save();

            return redirect()->route('quotas.index');
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }


    }

    public function updateitem(Request $request, int $item_id , int $quotas_id)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель') {
            $item = quotas_items::find($item_id);
            $item->IdCategories = $request->input('IdCategories');
            $item->ItemName = $request->input('ItemName');
            $item->ItemCost = $request->input('ItemCost');
            $item->ItemCount = $request->input('ItemCount');
            $item->ItemText = $request->input('ItemText');
            $item->save();
            return redirect()->route('quotas.edit', ['quota_id' => $quotas_id]);
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quotas  $quotas
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $quota)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель')
        {
            $quotas = quotas::find($quota);
            // каскадное удаление итемов
            DB::table('quotas_items')
                ->where('quotasId', '=', $quota)
                ->update(['isDelete' => 1]);
            $quotas->isDelete = 1;
            $quotas->save();
            return redirect()->route('quotas.index');
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }

    }


    public function additem(Request $request)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель') {
            quotas_items::create($request->all());
            return redirect()->route('quotas.edit', ['quota_id' => $request->get('QuotasId')]);
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }
    }




    public function destroyitem(int $item_id, int $quotas_id)
    {
        $user = auth()->user();// получили пользователя
        if($user->Roles == 'Покупатель') {
            $item = quotas_items::find($item_id);
            $item->isDelete = 1;
            $item->save();
            return redirect()->route('quotas.edit', ['quota_id' => $quotas_id]);
        }
        if ($user->Roles == 'Поставщик')
        {
            return view('home');
        }
    }
}
