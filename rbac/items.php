<?php

return [
    'uploadPractices' => [
        'type' => 2,
        'description' => 'Upload Practices',
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'uploadPractices',
        ],
    ],
];
