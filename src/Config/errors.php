<?php

return [
    "Success" => [
        "code"=>200,
        "http_code"=>200,
        "message" =>'با موفقیت انجام گردید'
    ],
    "Failed" => [
        "code"=>400,
        "http_code"=>404,
        "message" =>'انجام نشد'
    ],
    "BadRequest"=>[
        "code"=>500,
        "http_code"=>500,
        "message" =>'Bad Request'
    ],
    "Unauthorized"=>[
        "code"=>401,
        "http_code"=>401,
        "message" =>'عدم دسترسی'
    ],
    "Inaccessibility"=>[
        "code"=>403,
        "http_code"=>403,
        "message" =>'عدم دسترسی'
    ],
    "NotFound"=>[
        "code"=>404,
        "http_code"=>404,
        "message" =>'Not Found'
    ],
];
