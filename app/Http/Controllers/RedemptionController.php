<?php

namespace App\Http\Controllers;

use App\Redemption;
use App\Repositories\ResponseUtil;
use App\Voucher;
use Illuminate\Http\Request;
use DB;
use Validator;

class RedemptionController extends Controller
{
    /**
     * @SWG\Get(
     *      path="/redemption",
     *      summary="Get all listing of redemption.",
     *      tags={"Redemption"},
     *      description="Get all Redemption",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(ref="#/definitions/Response")
     *      )
     * )
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redemption = Redemption::paginate(10);
        if ($request->ajax() || $request->wantsJson()) {
            if($redemption->isEmpty()) {
                return response(ResponseUtil::makeSuccess(
                    $redemption, 'No Redemption Found', 404),
                    200);
            } else {
                return response(ResponseUtil::makeSuccess(
                    $redemption, 'Listing Redemption Successful', 200),
                    200);
            }
        } else {
            return view('redemption.index')->with(['redemption' => $redemption]);
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
     * @SWG\Post(
     *      path="/redemption",
     *      summary="Create a Redemption",
     *      tags={"Redemption"},
     *      description="Create a Redemption",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Redemption that should be created",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Redemption")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(ref="#/definitions/Response")
     *      )
     * )
     */
    /**
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array (
            'value' => 'required|numeric',
            'owner' => 'required|string|max:255',
        );
        $data = [
            "value" => $request->input('value'),
            "owner" => $request->input('owner'),
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ];

        if($request->input('voucher_id') != '' && $request->input('voucher_id') != null) {
            $rules['voucher_id'] = 'required|integer|exists:vouchers,id';
            $data['voucher_id'] = $request->input('voucher_id');
        } else if($request->input('voucher_code') != '' && $request->input('voucher_code') != null) {
            $rules['voucher_code'] = 'required|string|exists:vouchers,code';
            $data['voucher_code'] = $request->input('voucher_code');
        }

        $validator = Validator::make($data, $rules);
        if(!(isset($rules['voucher_id']) || isset($rules['voucher_code']))){
            $validator->after(function($validator) {
                $validator->errors()->add('voucher', 'The voucher_id or voucher_code field is required');
            });
        }

        if ($validator->fails()) {
            return response(ResponseUtil::makeFailure(
                $validator->errors()->all(),'Redemption Creation Failure', 500),
                200);
        } else {
            $voucher = null;
            if(isset($data['voucher_id'])){
                $voucher = Voucher::find($data['voucher_id']);
                $data['voucher_code'] = $voucher->code;
            } else {
                $voucher = Voucher::where('code', $data['voucher_code'])->first();
                $data['voucher_id'] = $voucher->id;
            }
            //Voucher Rules Starts Here
            if(!$voucher->is_percentage && $data['value'] > $voucher->value){
                return response(ResponseUtil::makeFailure(
                    ['Redemption value should be less than the Voucher value'],'Redemption Creation Failure', 500),
                    200);
            } else if($voucher->is_percentage && $data['value'] > $voucher->max_value) {
                return response(ResponseUtil::makeFailure(
                    ['Max voucher Redemption value is '.$voucher->max_value],'Redemption Creation Failure', 500),
                    200);
            }  else if (strtotime($voucher->expiry) < strtotime(date('Y-m-d H:i:s'))){
                return response(ResponseUtil::makeFailure(
                    ['Voucher is already Expired at '.$voucher->expiry],'Redemption Creation Failure', 500),
                    200);
            } else {
                $redemption = Redemption::where('voucher_id', $data['voucher_id'])->get();
                if(!$voucher->is_partial && $redemption->count()>0) {
                    return response(ResponseUtil::makeFailure(
                        ['This Voucher is already been redeemed, This Voucher can be redeemed only once'], 'Redemption Creation Failure', 500),
                        200);
                }
                $redeemed_value = 0;
                foreach ($redemption as $redeemed){
                    $redeemed_value += $redeemed->value;
                }
                $value = 0;
                if($voucher->is_percentage){
                    $value = $voucher->max_value-$redeemed_value;
                } else {
                    $value = $voucher->value-$redeemed_value;
                }
                if($data['value'] > $value) {
                    return response(ResponseUtil::makeFailure(
                        ['This Voucher is already been redeemed '.$redemption->count().' time(s), This Voucher can be redeemed more number of times for only '.$value.' value'],'Redemption Creation Failure', 500),
                        200);
                }
            }
            //Voucher Rules Ends Here
            $data['id'] = DB::table('redemption')->insertGetId($data);
            return response(ResponseUtil::makeSuccess(
                $data,'Redemption Creation Successful',200),
                200);
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
        //
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
        //
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
