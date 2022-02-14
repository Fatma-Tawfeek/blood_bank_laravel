<?php

function responseJson($status, $msg, $data = null) {
    $response = [
        'status' => $status,
        'msg' => $msg,
        'data' => $data,
    ];
    return response()->json($response);
}
