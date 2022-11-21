<?php

namespace PauloFelipeM\BrazilianValidator\Formats;

use Illuminate\Contracts\Validation\Rule;

class CpfCnpjFormat implements Rule
{
    /**
     * Valida o formato de CPF ou CNPJ
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        return (new CpfFormat())->passes($attribute, $value) || (new CnpjFormat())->passes($attribute, $value);
    }

    public function message(): string
    {
        return 'O campo :attribute não possui o formato de CPF ou CNPJ válido.';
    }
}