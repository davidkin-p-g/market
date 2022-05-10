<?php

namespace App\Http\Controllers\buyer;

use App\Http\Controllers\Controller;
use App\Models\quotas;
use App\Models\quotas_items;
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
        //
        $q = new quotas();
        return view('buyer.quotas.index', [
            'quotas' => $q->quotas()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('buyer.quotas.create', [
            'quotas'=> []
        ]);
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
        $q = quotas::create($request->all());
        $id = $q->id;
        return redirect()->route('quotas.edit',['quotas' => $q, 'quota' => $id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quotas  $quotas
     * @return \Illuminate\Http\Response
     */
    public function show(quotas $quotas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quotas  $quotas
     * @return \Illuminate\Http\Response
     */
    public function edit(int $quota, quotas $quotas)
    {
        $i = new quotas_items();
        $q = new quotas();
        return view('buyer.quotas.edit', [
            'quotas'=> $q->quota($quota),
            'items'=> $i->items($quota),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\quotas  $quotas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $quota)
    {
        if ($request->input('QPublished') == 'on')

        {
            DB::table('quotas_items')
                ->where('quotasId', '=', $quota)
                ->update(['ItemPublished' => 'on']);
        }
        else
        {
            DB::table('quotas_items')
                ->where('quotasId', '=', $quota)
                ->update(['ItemPublished' => null]);
        }
        $quota = quotas::find($quota);
        $quota->Name = $request->input('Name');
        $quota->Text = $request->input('Text');
        $quota->QPublished = $request->input('QPublished');
        //quotas::where('quotas_id', $quota)->first()->update($request->all());
        $quota->save();

        return redirect()->route('quotas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quotas  $quotas
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $quota)
    {
        //
        $quotas = quotas::find($quota);
        // каскадное удаление итемов
        DB::table('quotas_items')
            ->where('quotasId', '=', $quota)
            ->update(['isDelete' => 1]);
        $quotas->isDelete = 1;
        $quotas->save();
        return redirect()->route('quotas.index');
    }


    public function additem(Request $request)
    {
        //
        quotas_items::create($request->all());
        return redirect()->route('quotas.edit',['quota'=>$request->get('quotasId')]);
    }

    public function edititem(int $item_id , int $quotas_id )
    {
        $i = new quotas_items();
        $q = new quotas();
        return view('buyer.quotas.edititem', [
            'quotas'=> $q->quota($quotas_id),
            'items'=> $i->items($quotas_id),
            'item_id' => $item_id
        ]);
    }

    public function updateitem(Request $request, int $item_id , int $quotas_id)
    {
        $item = quotas_items::find($item_id);
        $item->ItemName = $request->input('ItemName');
        $item->ItemCost = $request->input('ItemCost');
        $item->ItemCount = $request->input('ItemCount');
        $item->save();
        return redirect()->route('quotas.edit', ['quota'=>$quotas_id]);

    }

    public function destroyitem(int $item_id, int $quotas_id)
    {
        //
        $item = quotas_items::find($item_id);
        $item->isDelete = 1;
        $item->save();
        return redirect()->route('quotas.edit', ['quota'=>$quotas_id]);
    }
}
