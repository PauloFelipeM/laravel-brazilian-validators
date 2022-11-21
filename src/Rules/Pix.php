<?php

namespace PauloFelipeM\BrazilianValidator\Rules;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Contracts\Validation\Rule;
use PauloFelipeM\BrazilianValidator\Enums\PixTypeEnum;

class Pix implements Rule
{
    protected $pixKeyType;

    public function __construct($pixKeyType)
    {
        $this->pixKeyType = $pixKeyType;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        switch ($this->pixKeyType) {
            case PixTypeEnum::CPF_CNPJ->value:
                return (new CpfCnpj())->passes($attribute, $value);
            case PixTypeEnum::EMAIL->value:
                return (new EmailValidator())->isValid($value, new RFCValidation());
            case PixTypeEnum::CELULAR->value:
                return (new Phone())->passes($attribute, $value);
            case PixTypeEnum::ALEATORIA->value:
                $regex =
                    '/[[:xdigit:]]{8}-?[[:xdigit:]]{4}-?4[[:xdigit:]]{3}-?[89aAbB][[:xdigit:]]{3}-?[[:xdigit:]]{12}/';
                return !empty(preg_match($regex, $value));
            default:
                return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return '';
    }
}