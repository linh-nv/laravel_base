<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/15/2019
 * Time: 11:18 PM
 */

namespace App\TraitHelpers;


trait ApiResponseTrait
{
    public function handleExecuteActionResponse($status, $message, array $moreData = [])
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];
        if (!empty($moreData)) {
            $response= array_merge($response, $moreData);
        }
        return $response;

    }

    public function handleResourceResponse($status, array $moreData = [], $message = null)
    {
        $response = [
            'status' => $status,
        ];
        if ($message) {
            $response['message'] = $message;
        }
        if (!empty($moreData)) {
            $response= array_merge($response, $moreData);
        }

        return $response;
    }

    public function handleResourcesResponse($status, array $moreData = [], $message = null)
    {
        $response = [
            'status' => $status,
        ];
        if ($message) {
            $response['message'] = $message;
        }
        if (!empty($moreData)) {
            $response= array_merge($response, $moreData);
        }
        return $response;
    }
}
