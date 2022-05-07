<?php

namespace App\Http\Controllers\buyer;

use App\Http\Controllers\Controller;
use App\Models\quotas;
use App\Models\quotas_items;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('buyer.quotas.index', [
            'quotas' => quotas::paginate(10)
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
        quotas::create($request->all());
        return redirect()->route('quotas.index');
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
        return view('buyer.quotas.edit', [
            'quotas'=> quotas::where('id', $quota)->first(),
            'items'=> quotas_items::where('quotasId',$quota)->get()
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
        $quota = quotas::find($quota);
        $quota->Name = $request->input('Name');
        $quota->Text = $request->input('Text');
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
    public function destroy(quotas $quotas)
    {
        //
    }
}
