<?php
/**
 * Created by IntelliJ IDEA.
 * User: Seadon Francis Pinto
 * Date: 2017/10/04
 * Time: 11:38 AM
 */

namespace App\Repositories;

/**
 * @SWG\Definition(
 *      definition="Response",
 *      @SWG\Property(
 *          property="success",
 *          description="Response status",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="data",
 *          description="Response Data",
 *          type="object"
 *      ),
 *     @SWG\Property(
 *          property="responseMessage",
 *          description="Response Message",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="responseCode",
 *          description="Response code",
 *          type="integer"
 *      )
 * )
 */
class ResponseUtil
{
    /**
     * @param mixed  $data
     * @param string $message
     * @param integer $code
     *
     * @return array
     */
    public static function makeSuccess($data, $message, $code=000)
    {
        return [
            'success'           => true,
            'data'              => $data,
            'responseMessage'    => $message, //Feature Response message
            'responseCode'      => $code, //Feature Response code
        ];
    }

    /**
     * @param mixed  $data
     * @param string $message
     * @param integer $code
     *
     * @return array
     */
    public static function makeFailure($data, $message, $code=999)
    {
        return [
            'success'           => false,
            'data'              => $data,
            'responseMessage'    => $message, //Feature Response message
            'responseCode'      => $code, //Feature Response code
        ];
    }

    /**
     *
     * @return array
     */
    public static function makeAccessMissing()
    {
        return [
            'success'           => false,
            'data'              => [],
            'responseDetail'    => 'Your access token is missing, Please provide a valid access token',
            'responseCode'      => 404,
        ];
    }

    /**
     *
     * @return array
     */
    public static function makeAccessDisabled()
    {
        return [
            'success'           => false,
            'data'              => [],
            'responseDetail'    => 'Your access token is disabled, Please contact the administrator',
            'responseCode'      => 401,
        ];
    }

    /**
     *
     * @return array
     */
    public static function makeAccessInvalid()
    {
        return [
            'success'           => false,
            'data'              => [],
            'responseDetail'    => 'Your access token is invalid, Please provide a valid access token',
            'responseCode'      => 501,
        ];
    }

    /**
     * @param string $message
     * @param integer $code
     *
     * @return array
     */
    public static function makeAccessFailure($message, $code=555)
    {
        return [
            'success'           => false,
            'data'              => [],
            'responseMessage'    => $message, //Feature Response message
            'responseCode'      => $code, //Feature Response code
        ];
    }
}