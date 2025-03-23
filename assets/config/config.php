<?php

use Hanafalah\ModulePayer\Models as ModulePayer;

return [
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts'
    ],
    'database' => [
        'models' => [
            'Payer'   => ModulePayer\Payer::class,
            'Company' => ModulePayer\Company::class,
        ]
    ],
];
