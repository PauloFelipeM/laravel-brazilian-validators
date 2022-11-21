<?php

namespace PauloFelipeM\BrazilianValidator\Enums;

enum PixTypeEnum: string
{
    case CPF_CNPJ = 'cpf_cnpj';
    case EMAIL = 'email';
    case CELULAR = 'celular';
    case ALEATORIA = 'aleatoria';
}
