<?php

namespace PauloFelipeM\BrazilianValidator\Formats;

use Illuminate\Contracts\Validation\Rule;

class CepFormat implements Rule
{
    /**
     * Valida se o formato de CEP está correto
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        return !empty(preg_match('/^\d{2}\.?\d{3}-\d{3}$/', $value));
    }

    public function message(): string
    {
        return 'O campo :attribute não possui o formato de CEP válido.';
    }
}