<?php

namespace App\Http\Middleware;

use App\Client;
use App\Repositories\ResponseUtil;
use Closure;

class TokenEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->has('api_token') || $request->has('api_token') == ""){
            return response(ResponseUtil::makeAccessMissing(),200);
        } else {
            $access = Client::where([
                ['api_token', '=', $request->input('api_token')],
            ])->first();

            if($access == null){
                return response(ResponseUtil::makeAccessInvalid(),200);
            } else if($access->is_active==0){
                return response(ResponseUtil::makeAccessDisabled(),200);
            }
        }

        return $next($request);
    }
}
