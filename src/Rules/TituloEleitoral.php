<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class TituloEleitoral implements Rule
{
    /**
     * Valida se o Título Eleitoral é válido
     *
     * @param string $attribute
     * @param string $value
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        $te = str_pad(preg_replace('[^0-9]', '', $value), 12, '0', STR_PAD_LEFT);
        $uf = (int) substr($te, 8, 2);
        if ($uf < 1 || $uf > 28 || strlen($te) !== 12) {
            return false;
        }

        $d = 0;
        for ($i = 0; $i < 8; $i++) {
            $d += $te{$i} * (9 - $i);
        }

        $d %= 11;
        if ($d < 2) {
            if ($uf < 3) {
                $d = 1 - $d;
            } else {
                $d = 0;
            }
        } else {
            $d = 11 - $d;
        }

        if ($te[10] !== $d) {
            return false;
        }

        $d *= 2;
        for ($i = 8; $i < 10; $i++) {
            $d += $te{$i} * (12 - $i);
        }

        $d %= 11;
        if ($d < 2) {
            if ($uf < 3) {
                $d = 1 - $d;
            } else {
                $d = 0;
            }
        } else {
            $d = 11 - $d;
        }

        return $te[11] === $d;
    }

    public function message(): string
    {
        return 'O campo :attribute não é título de eleitor válido.';
    }
}