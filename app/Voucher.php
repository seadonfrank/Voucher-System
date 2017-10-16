<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *      definition="Vouchers",
 *      @SWG\Property(
 *          property="currency",
 *          description="currency",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          description="value",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="max_value",
 *          description="max_value",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="expiry",
 *          description="expiry",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="owner",
 *          description="owner",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="is_percentage",
 *          description="is_percentage",
 *          type="boolean",
 *      ),
 *     @SWG\Property(
 *          property="is_partial",
 *          description="is_partial",
 *          type="boolean",
 *      ),
 * )
 */
class Voucher extends Model
{
    //
}
