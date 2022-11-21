<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class PlacaVeiculo implements Rule
{
    /**
     * Valida se é uma placa de veículo válida
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        $regex = '/^[A-Z][0-9]{5}$|' . // Placas dos anos 1915-1941 [ex A12345]
            '^[0-9]{7}$|' . // Placas dos anos 1941-1969 [ex 1234567]
            '^[A-Z]{2}[0-9]{4}$|' . // Placas dos anos 1969-1990 [ex AA1234]
            '^[A-Z]{3}[0-9]{4}$|' . // Placas dos anos 1990-2018 [ex AAA1234]
            '^[A-Z]{3}[0-9]{1}[A-Z]{1}[0-9]{2}$|' . // Placas de carros dos anos 2018+ [ex AAA1A23]
            '^[A-Z]{3}[0-9]{2}[A-Z]{1}[0-9]{1}$' . // Placas de motos dos anos 2018+ [ex AAA12A3]
            '/i';

        return !empty(preg_match($regex, $value));
    }

    /**
     *
     * @return string
     */
    public function message(): string
    {
        return 'O campo :attribute não é uma placa de veículo válida.';
    }
}
