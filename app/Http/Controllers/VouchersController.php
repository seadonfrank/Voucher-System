<?php

namespace App\Http\Controllers;

use App\Repositories\ResponseUtil;
use App\Voucher;
use Illuminate\Http\Request;
use DB;
use Validator;

class VouchersController extends Controller
{
    /**
     * @SWG\Get(
     *      path="/vouchers",
     *      summary="Get all listing of vouchers.",
     *      tags={"Vouchers"},
     *      description="Get all Vouchers",
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
    public function index()
    {
        //
        $vouchers = Voucher::paginate();
        if($vouchers->isEmpty()) {
            return response(ResponseUtil::makeSuccess(
                $vouchers, 'No Vouchers Found', 404),
                200);
        } else {
            return response(ResponseUtil::makeSuccess(
                $vouchers, 'Listing Voucher Successful', 200),
                200);
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
     *      path="/vouchers",
     *      summary="Store a newly created Voucher",
     *      tags={"Vouchers"},
     *      description="Store a Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Voucher that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Vouchers")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(ref="#/definitions/Response")
     *      )
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = array (
            'code' => 'required|string|unique:vouchers,code',
            'currency' => 'required|string|max:5',
            'value' => 'required|numeric',
            'max_value' => 'required|numeric',
            'expiry' => 'required|date|max:255',
            'is_percentage' => 'required|boolean',
            'is_partial' => 'required|boolean',
            'owner' => 'required|string|max:255',
        );
        $data = [
            "code" => substr(md5(microtime()),rand(0,26),12),
            "currency" => $request->input('currency'),
            "value" => $request->input('value'),
            "max_value" => $request->input('max_value'),
            "expiry" => date('Y-d-m H:i:s',strtotime($request->input('expiry'))),
            "owner" => $request->input('owner'),
            "is_percentage" => (boolean)$request->input('is_percentage'),
            "is_partial" => (boolean)$request->input('is_partial'),
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ];

        $validator = Validator::make($data, $rules);
        if($data['is_percentage'] && $data['is_partial']) {
            $validator->after(function($validator) {
                $validator->errors()->add('percentagePartial', 'The partial field should be set to false, If Percentage field is set to true');
            });
        }

        if ($validator->fails()) {
            return response(ResponseUtil::makeFailure(
                $validator->errors()->all(),'Voucher Creation Failure', 500),
                200);
        } else {
            $data['id'] = DB::table('vouchers')->insertGetId($data);
            return response(ResponseUtil::makeSuccess(
                $data,'Voucher Creation Successful',200),
                200);
        }
    }

    /**
     * @SWG\Get(
     *      path="/vouchers/{id}",
     *      summary="Get a particular instance of voucher.",
     *      tags={"Vouchers"},
     *      description="Show a Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Voucher Id.",
     *          in="path",
     *          required=true,
     *          type="integer"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(ref="#/definitions/Response")
     *      )
     * )
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $rules = array (
            'id' => 'required|integer|exists:vouchers,id',
        );
        $validator = Validator::make(array('id' => $id), $rules);
        if ($validator->fails()) {
            return response(ResponseUtil::makeFailure(
                $validator->errors()->all(),'Listing a Voucher Failure',500),
                200);
        } else {
            $voucher = Voucher::findOrFail($id);
            if($voucher) {
                return response(ResponseUtil::makeSuccess(
                    $voucher, 'Listing a Voucher Successful', 200),
                    200);
            } else {
                return response(ResponseUtil::makeSuccess(
                    $voucher, 'No Vouchers Found', 404),
                    200);
            }
        }
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
     * @SWG\Put(
     *      path="/vouchers/{id}",
     *      summary="Update a particular instance of voucher.",
     *      tags={"Vouchers"},
     *      description="Update a Voucher",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="Voucher Id.",
     *          in="path",
     *          required=true,
     *          type="integer"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Vouchers that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Vouchers")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(ref="#/definitions/Response")
     *      )
     * )
     */
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
        $rules = array (
            'id' => 'required|integer|exists:vouchers,id',
            'currency' => 'string|max:5',
            'value' => 'numeric',
            'max_value' => 'numeric',
            'expiry' => 'date|max:255',
            'is_percentage' => 'boolean',
            'is_partial' => 'boolean',
            'owner' => 'string|max:255',
        );
        $validator = Validator::make(array_merge((array)$request->all(), array('id' => $id)), $rules);
        if ($validator->fails()) {
            return response(ResponseUtil::makeFailure(
                $validator->errors()->all(),'Updating a Voucher Failure',500),
                200);
        } else {
            $voucher = Voucher::findOrFail($id);
            if($voucher) {
                if($request->has('currency'))
                    $voucher->currency = $request->input('currency');
                if($request->has('value'))
                    $voucher->value = $request->input('value');
                if($request->has('max_value'))
                    $voucher->max_value = $request->input('max_value');
                if($request->has('expiry'))
                    $voucher->expiry = date('Y-d-m H:i:s',strtotime($request->input('expiry')));
                if($request->has('is_percentage'))
                    $voucher->is_percentage = $request->input('is_percentage');
                if($request->has('is_partial'))
                    $voucher->is_partial = $request->input('is_partial');
                if($request->has('owner'))
                    $voucher->owner = $request->input('owner');
                if($voucher->save()) {
                    return response(ResponseUtil::makeSuccess(
                        $voucher, 'Listing a Voucher Successful', 200),
                        200);
                } else {
                    return response(ResponseUtil::makeSuccess(
                        [], 'Updating a Voucher Failure', 500),
                        200);
                }
            } else {
                return response(ResponseUtil::makeSuccess(
                    $voucher, 'No Vouchers Found', 200),
                    200);
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
