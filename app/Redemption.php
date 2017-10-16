<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Redemption",
 *     @SWG\Property(
 *          property="voucher_id",
 *          description="voucher_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="voucher_code",
 *          description="voucher_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="owner",
 *          description="owner",
 *          type="string"
 *      )
 * )
 */
class Redemption extends Model
{
    //
    protected $table = "redemption";
}
