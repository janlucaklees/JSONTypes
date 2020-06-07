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

    protected bool $required;

    public function __construct()
    {
        $this->validationStack = [];
        $this->required        = false;
    }

    protected function addValidator(Closure $validator)
    {
        array_push($this->validationStack, $validator);

        return $this;
    }

    public function isValid($object)
    {
        foreach ($this->validationStack as $validator) {
            if(!$validator($object)) {
                return false;
            }
        }
        return true;
    }

    public function isRequired()
    {
        $this->required = true;

        return $this;
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

    public function isRequired()
    {
        parent::isRequired();

        return $this->notEmpty();
    }
}

class ObjectValidator extends AbstractValidator
{
    private $schema;

    public function __construct($schema)
    {
        parent::__construct();

        $this->schema = $schema;
    }

    /**
     * @param $object
     * @return bool
     * @throws Exception
     */
    public function isValid($object)
    {
        if(!is_object($object)) {
            return false;
        }

        /**
         * @var object $object
         */
        foreach ($this->schema as $key => $validator) {
            if(!($validator instanceof AbstractValidator)) {
                throw new Exception('Give me a real validator!');
            }

            /**
             * @var AbstractValidator $validator
             */
            if(property_exists($object, $key)) {
                if(!$validator->isValid($object->{$key})) {
                    return false;
                }
            } else {
                if($validator->required) {
                    return false;
                }
            }
        }

        return true;
    }
}
