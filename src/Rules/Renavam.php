<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class Renavam implements Rule
{
    /**
     * Valida se é um renavam válido
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        $soma = 0;
        $d = str_split($value);
        $x = 0;

        for ($i = 5; $i >= 2; $i--) {
            $soma += $d[$x] * $i;
            $x++;
        }

        $valor = $soma % 11;
        if ($valor == 11 || $valor == 0 || $valor >= 10) {
            $digito = 0;
        } else {
            $digito = $valor;
        }

        // Verifica digito com a 5 posição do array
        return $digito == $d[4];
    }

    /**
     *
     * @return string
     */
    public function message(): string
    {
        return 'O campo :attribute não é um renavam válido.';
    }
}
