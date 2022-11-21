<?php

namespace PauloFelipeM\BrazilianValidator;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\ServiceProvider;

class BrazilianValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $rules = [
            'phone' => \PauloFelipeM\BrazilianValidator\Rules\Phone::class,
            'phone_ddd' => \PauloFelipeM\BrazilianValidator\Rules\PhoneCode::class,
            'cpf' => \PauloFelipeM\BrazilianValidator\Rules\Cpf::class,
            'cnpj' => \PauloFelipeM\BrazilianValidator\Rules\Cnpj::class,
            'cpf_cnpj' => \PauloFelipeM\BrazilianValidator\Rules\CpfCnpj::class,
            'cnh' => \PauloFelipeM\BrazilianValidator\Rules\Cnh::class,
            'cns' => \PauloFelipeM\BrazilianValidator\Rules\Cns::class,
            'pis' => \PauloFelipeM\BrazilianValidator\Rules\Pis::class,
            'uf' => \PauloFelipeM\BrazilianValidator\Rules\Uf::class,
            'titulo_eleitor' => \PauloFelipeM\BrazilianValidator\Rules\TituloEleitoral::class,
            'renavam' => \PauloFelipeM\BrazilianValidator\Rules\Renavam::class,
            'nis' => \PauloFelipeM\BrazilianValidator\Rules\Nis::class,
            'placa_veiculo' => \PauloFelipeM\BrazilianValidator\Rules\PlacaVeiculo::class,

            'cnpj_format' => \PauloFelipeM\BrazilianValidator\Formats\CnpjFormat::class,
            'cpf_format' => \PauloFelipeM\BrazilianValidator\Formats\CpfFormat::class,
            'cep_format' => \PauloFelipeM\BrazilianValidator\Formats\CepFormat::class,
            'pis_format' => \PauloFelipeM\BrazilianValidator\Formats\PisFormat::class,
            'cpf_cnpj_format' => \PauloFelipeM\BrazilianValidator\Formats\CpfCnpjFormat::class,
        ];

        foreach ($rules as $name => $class) {
            /** @var Rule $rule */
            $rule = new $class();

            $extension = static function ($attribute, $value) use ($rule) {
                return $rule->passes($attribute, $value);
            };

            $this->app['validator']->extend($name, $extension, $rule->message());
        }

        $this->app['validator']->extend('pix', function ($attribute, $value, $parameters) {
            return (new \PauloFelipeM\BrazilianValidator\Rules\Pix($parameters[0]))->passes($attribute, $value);
        }, 'Chave PIX inválida');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
    }
}
