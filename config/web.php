<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 05.02.2018
 * Time: 20:01
 */
return[
    'id'=>'crmapp',
    'basePath'=>realpath(__DIR__.'/../'),
    'components'=>[
        'request'=>[
            'cookieValidationKey'=>'secret_key_cookie'
        ]
    ]
];