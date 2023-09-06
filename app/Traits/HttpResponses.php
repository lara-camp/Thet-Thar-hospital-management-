<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait HttpResponses
{

    protected function success($message, $data = null, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($message, $data = null, $code = 422)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function getPaginationMeta(LengthAwarePaginator $data)
    {
        return [
            'currentPage' => $data->currentPage(),
            'totalPages' => $data->lastPage(),
            'startOffset' => $data->firstItem(),
            'endOffset' => $data->lastItem(),
            'totalItems' => $data->total(),
        ];
    }
}
