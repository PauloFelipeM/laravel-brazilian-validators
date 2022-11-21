<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;
use PauloFelipeM\BrazilianValidator\Enums\StateEnum;

class Uf implements Rule
{
    /**
     * Valida se o UF! É válido
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        return !is_null(StateEnum::tryFrom($value));
    }

    /**
     *
     * @return string
     */
    public function message(): string
    {
        return 'O campo :attribute não é uma UF válida.';
    }
}
