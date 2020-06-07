<?php

declare(strict_types=1);

use JanLucaKlees\JSONTypes;
use PHPUnit\Framework\TestCase;


final class StringTest extends TestCase
{
    public function testCanHaveAValue(): void
    {
        $validator = JSONTypes::string();

        $this->assertTrue($validator->isValid('This is a test string!'));
    }

    public function testCanBeEmpty(): void
    {
        $validator = JSONTypes::string();

        $this->assertTrue($validator->isValid(''));
        $this->assertTrue($validator->isValid(""));
    }

    public function testCanNotBeANumber(): void
    {
        $validator = JSONTypes::string();

        $this->assertFalse($validator->isValid(42));
    }

    public function testCanNotBeNull(): void
    {
        $validator = JSONTypes::string();

        $this->assertFalse($validator->isValid(null));
    }

    public function testCanNotBeAnArray(): void
    {
        $validator = JSONTypes::string();

        $this->assertFalse($validator->isValid([]));
        $this->assertFalse($validator->isValid(['This is a string, but this should not be valid.']));
    }


    public function testCanNotBeAnObject(): void
    {
        $validator = JSONTypes::string();

        $this->assertFalse($validator->isValid([]));
        $this->assertFalse($validator->isValid((object) ['string' => 'This is a string, but this should not be valid.']));
    }
}
