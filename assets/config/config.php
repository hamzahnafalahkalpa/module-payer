<?php

use Hanafalah\ModulePayer\{
    Commands
};

return [
    'namespace' => 'Hanafalah\\ModulePayer',
    'libs' => [
        'model'    => 'Models',
        'contract' => 'Contracts',
        'schema'   => 'Schemas'
    ],
    'database' => [
        'models' => [
        ]
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [

        ]
    ],
    'commands' => [
        Commands\InstallMakeCommand::class
    ]
];
