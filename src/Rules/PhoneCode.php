<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneCode implements Rule
{
    /**
     * Valida o formato do celular
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        return !empty(preg_match('/^[+]\d{1,2}\s?\(?\d{2}\)?\s?\d{5}\-?\d{4}$/', $value));
    }

    public function message(): string
    {
        return 'O campo :attribute não é um número telefônico com código válido.';
    }
}