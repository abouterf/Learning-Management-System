<?php


namespace abouterf\Common\Responses;


use Illuminate\Http\Response;

class AjaxResponse
{
    public static function successResponse()
    {
        return response()->json(['message' => 'عملیات با موفقیت انجام شد.'], Response::HTTP_OK);
    }

    public static function failedResponse()
    {
        return response()->json(['message' => 'عملیات ناموفق!'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
