<?php

namespace PauloFelipeM\BrazilianValidator\Formats;

use Illuminate\Contracts\Validation\Rule;

class CnpjFormat implements Rule
{
    /**
     * Valida o formato do cnpj
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        return !empty(preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value));
    }

    public function message(): string
    {
        return 'O campo :attribute não possui o formato de CNPJ válido.';
    }
}