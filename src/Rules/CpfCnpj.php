<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfCnpj implements Rule
{
    /**
     * Valida se o campo é um CPF ou um CNPJ válido
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {

        return (new Cpf())->passes($attribute, $value) || (new Cnpj())->passes($attribute, $value);
    }

    public function message(): string
    {
        return 'O campo :attribute não é um CPF/CNPJ válido.';
    }
}