<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Validator;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.index', ['clients' => Client::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'api_token' => 'required|string|max:255|min:10|unique:clients'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('clients/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $client = new Client();
            $client->name = $request->input('name');
            $client->api_token = $request->input('api_token');
            $client->is_active = true;
            if($client->save()) {
                return redirect('clients');
            } else{
                //ToDO: have a 500 error view
                //internal server error
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('clients.edit', ['client' => Client::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'api_token' => 'required|string|max:255|min:10|unique:clients,api_token,'.$id,
            'is_active' => 'required|required_if:on,off'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('clients/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $client = Client::find($id);
            $client->name = $request->input('name');
            $client->api_token = $request->input('api_token');
            $client->is_active = ($request->input('is_active')=="true")?1:0;
            if($client->save()) {
                return redirect('clients');
            } else{
                //ToDO: have a 500 error view
                //internal server error
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
