<?php


namespace abouterf\Category\Responses;


use Illuminate\Http\Response;

class AjaxResponse
{
    public static function successResponse()
    {
        return response()->json(['message' => 'عملیات با موفقیت انجام شد.'], Response::HTTP_OK);

    }
}
