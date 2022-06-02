<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Phones;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClientResource::collection(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        if($request->hasFile('image')){
            $uploaded_path = $request->file('image')->store('images/profile/client', 'public');
        }else{
            $uploaded_path = 'NULL';
        }

        $validated = $request->safe()->merge(['image_path' => $uploaded_path]);

        $client = Client::create($validated->except(['phones', 'sellers']));

        foreach($validated->only(['phones'])['phones'] as $key => $phone){

            Phones::create(['client_id' => $client->id, 'number' => $phone]);
            
        }

        $client->sellers()->attach($validated->only('sellers')['sellers']);

        return response()->json(['message' => "Client ID: $client->id"], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {

        $client->update($request->validated());

        return response()->json(['message' => 'Client was updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(['message' => 'Client was deleted'], 200);
    }
}
