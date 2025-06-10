<?php

return [

    'default' => env('BROADCAST_CONNECTION', 'pusher'),

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_KEY'),
            'secret' => env('PUSHER_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'), 
                'useTLS' => false, 
            ],
        ],

    ],

];
