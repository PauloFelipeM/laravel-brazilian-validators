<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cns implements Rule
{
    /**
     * Valida se o CNS é válido
     *
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!isset($value[0])) {
            return false;
        }

        $digit = (int) $value[0];

        if (strlen($value) != 15 || preg_match("/^{$digit}{15}$/", $value) > 0) {
            return false;
        }

        return $digit >= 7 ? $this->cnsProv($value) : $this->cns($value);
    }

    public function message(): string
    {
        return 'O campo :attribute não é um CNS válido.';
    }

    /**
     * Valida o CNS menor que 7 no primeiro dígito
     * @param string $cns
     * @return bool
     */
    protected function cns(string $cns): bool
    {
        $pis = substr($cns, 0, 11);

        for ($sum = 0, $i = 0, $j = 15; $i <= 10; $i++, $j--) {
            $sum += intval($pis[$i]) * $j;
        }

        $dv = 11 - ($sum % 11);

        $dv != 11 ?: $dv = 0;

        if ($dv === 10) {
            for ($sum = 2, $i = 1, $j = 15; $i <= 10; $i++, $j--) {
                $sum += (int) substr($pis, $i - 1, $i) * $j;
            }

            $dv = 11 - ($sum % 11);
            $dv != 11 ?: $dv = 0;

            $resultado = $pis . "001" . $dv;
        } else {
            $resultado = $pis . "000" . $dv;
        }

        return $cns === $resultado;
    }

    /**
     * Valida o CNS que inicia por 7, 8 ou 9
     * @param string $cns
     * @return bool
     */
    protected function cnsProv(string $cns): bool
    {
        if (strlen($cns) != 15) {
            return false;
        }

        for ($s = 0, $i = 0, $j = 15; $i < 15; $i++, $j--) {
            $s += (int) $cns[$i] * $j;
        }

        return $s % 11 === 0;
    }
}

