<?php

if (!function_exists('putJsonError')) {
    function putJsonError($data = [])
    {
        $array = [
            'status' => 'ng',
            'content' => $data,
        ];
        return json_encode($array);
    }
}

if (!function_exists('putJsonSuccess')) {
    function putJsonSuccess($data = [])
    {
        $array = [
            'status' => 'ok',
            'content' => $data,
        ];
        return json_encode($array);
    }
}
