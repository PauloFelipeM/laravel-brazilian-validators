<?php

namespace PauloFelipeM\BrazilianValidator\Formats;

use Illuminate\Contracts\Validation\Rule;

class PisFormat implements Rule
{
    /**
     * Valida o formato do Número do PIS
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        return !empty(preg_match('/^\d{3}\.\d{5}\.\d{2}-\d{1}$/', $value));
    }

    public function message(): string
    {
        return 'O campo :attribute não é um formato de PIS válido.';
    }
}