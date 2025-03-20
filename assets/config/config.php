<?php

use Hanafalah\ModulePayer\Models as ModulePayer;

return [
    'database' => [
        'models' => [
            'Payer'   => ModulePayer\Payer::class,
            'Company' => ModulePayer\Company::class,
        ]
    ],
];
