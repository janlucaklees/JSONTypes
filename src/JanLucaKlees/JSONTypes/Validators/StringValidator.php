<?php

namespace JanLucaKlees\JSONTypes\Validators;


class StringValidator extends AbstractValidator
{
    private const MAIL_REGEX = '/^\S+@\S+\.\S{2,3}$/';

    public function __construct()
    {
        parent::__construct();

        return $this->addValidator(fn($value) => is_string($value));
    }

    public function matches($regex)
    {
        return $this->addValidator(fn($value) => preg_match($regex, $value));
    }

    public function isEmailAddress()
    {
        return $this->matches(self::MAIL_REGEX);
    }

    public function notEmpty()
    {
        return $this->addValidator(fn($value) => $value !== '');
    }

    public function isRequired()
    {
        parent::isRequired();

        return $this->notEmpty();
    }
}
