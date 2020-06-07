<?php

namespace JanLucaKlees;

use JanLucaKlees\JSONTypes\Validators\ObjectValidator;
use JanLucaKlees\JSONTypes\Validators\StringValidator;


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
