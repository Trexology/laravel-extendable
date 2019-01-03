<?php
/**
 * Created by PhpStorm.
 * User: antonpauli
 * Date: 30/07/15
 * Time: 14:28
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Extendable
    |--------------------------------------------------------------------------
    |
    | Laravel Extendable add support for custom fields.
    | New model attributes can be added without migrations.
    | Configure your custom fields below.
    |
    */


    /*
    'App\Room' => [                                                 // model name
        'light' => [                                                // field name
            'title' => 'Light',                                     // field title (can be used in views)
            'type' => \Trexology\Extendable\CustomFieldType::Radio, // field type
            'options' => [                                          // possible values/labels
                0 => 'Off',
                1 => 'On'
            ],
            'default' => 1                                          // default value
        ]
    ]
    */

];
