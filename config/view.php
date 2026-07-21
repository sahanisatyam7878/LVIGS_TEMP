<?php

return [
    'paths' => [
        resource_path('views'),
    ],

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(base_path('bootstrap/cache/views')) ?: base_path('bootstrap/cache/views')
    ),
];
