<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Http\Resources\SellerResource;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SellerResource::collection(Seller::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSellerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSellerRequest $request)
    {

        $seller = Seller::create($request->validated());

        return response()->json(['message' => "Seller ID: $seller->id"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        return new SellerResource($seller);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSellerRequest  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellerRequest $request, Seller $seller)
    {
        $seller->update($request->validated());

        return response()->json(['message' => 'Seller was updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();

        return response()->json(['message' => 'Client was deleted'], 200);
    }
}
