<?php

namespace JanLucaKlees\JSONTypes\Validators;

use Closure;


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
