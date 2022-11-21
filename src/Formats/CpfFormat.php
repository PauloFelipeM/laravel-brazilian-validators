<?php

namespace PauloFelipeM\BrazilianValidator\Formats;

use Illuminate\Contracts\Validation\Rule;

class CpfFormat implements Rule
{
    /**
     * Valida o formato do cpf
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        return !empty(preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value));
    }

    public function message(): string
    {
        return 'O campo :attribute não possui o formato de CPF válido.';
    }
}