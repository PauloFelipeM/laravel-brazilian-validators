<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
{
    /**
     * Valida se o CPF é válido
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--) {
            $sum += $value[$i] * $j;
        }

        $result = $sum % 11;

        if ($value[9] != ($result < 2 ? 0 : 11 - $result)) {
            return false;
        }

        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--) {
            $sum += $value[$i] * $j;
        }

        $result = $sum % 11;

        return $value[10] == ($result < 2 ? 0 : 11 - $result);
    }

    public function message(): string
    {
        return 'O campo :attribute não é um CPF válido.';
    }
}