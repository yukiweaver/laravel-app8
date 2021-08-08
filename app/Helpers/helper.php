<?php

if (!function_exists('putJsonError')) {
    function putJsonError($data = [])
    {
        $array = [
            'status' => 'ng',
            'content' => $data,
        ];
        return response()->json($array, 200);
    }
}

if (!function_exists('putJsonSuccess')) {
    function putJsonSuccess($data = [])
    {
        $array = [
            'status' => 'ok',
            'content' => $data,
        ];
        return response()->json($array, 200);
    }
}
