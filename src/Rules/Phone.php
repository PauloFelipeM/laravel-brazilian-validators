<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{
    /**
     * Valida o formato do celular
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        return !empty(preg_match('/^\(?\d{2}\)?\s?\d{5}\-?\d{4}$/', $value));
    }

    public function message(): string
    {
        return 'O campo :attribute não é um número telefônico válido.';
    }
}