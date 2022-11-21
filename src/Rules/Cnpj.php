<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cnpj implements Rule
{
    /**
     * Valida se o CNPJ é válido
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        // Validate first check digit
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $result = $sum % 11;
        if ($value[12] != ($result < 2 ? 0 : 11 - $result)) {
            return false;
        }

        // Validate second check digit
        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        return $value[13] == ($result < 2 ? 0 : 11 - $result);
    }


    public function message(): string
    {
        return 'O campo :attribute não é um CNPJ válido.';
    }
}