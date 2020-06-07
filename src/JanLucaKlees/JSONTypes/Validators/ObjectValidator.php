<?php

namespace JanLucaKlees\JSONTypes\Validators;


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
