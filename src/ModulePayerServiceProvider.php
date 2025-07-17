<?php

namespace Hanafalah\ModulePayer;

use Hanafalah\ModulePayer\{
    Schemas\Payer as SchemaPayer,
    Schemas\Company as SchemaCompany
};
use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;

class ModulePayerServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMainClass(ModulePayer::class)
            ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers([
                '*',
                'Services'  => function () {
                    $this->binds([
                        Contracts\ModulePayer::class  => ModulePayer::class,
                        Contracts\Payer::class        => SchemaPayer::class,
                        Contracts\Company::class      => SchemaCompany::class,
                    ]);
                },
            ]);
    }

    protected function dir(): string
    {
        return __DIR__ . '/';
    }

    protected function migrationPath(string $path = ''): string
    {
        return database_path($path);
    }
}
