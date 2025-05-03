<?php

use Hanafalah\ModulePayer\{
    Commands
};

return [
    'namespace' => 'Hanafalah\\ModulePayer',
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
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
