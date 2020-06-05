<?php


class JSONTypes
{
    public static function object($object)
    {
        return new ObjectValidator($object);
    }

    public static function string()
    {
        return new StringValidator();
    }
}

abstract class AbstractValidator
{
    /**
     * @var Closure[]
     */
    private array $validationStack;

    public function __construct()
    {
        $this->validationStack = [];
    }

    protected function addValidator(Closure $validator)
    {
        array_push($this->validationStack, $validator);

        return $this;
    }

    public function isValid($value)
    {
        foreach ($this->validationStack as $validator) {
            if(!$validator($value)) {
                return false;
            }
        }
        return true;
    }

    public function isRequired()
    {
        return $this->addValidator(fn($value) => !empty($value));

    }
}


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
}