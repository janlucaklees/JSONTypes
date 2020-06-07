<?php

declare(strict_types=1);

use JanLucaKlees\JSONTypes;
use PHPUnit\Framework\TestCase;


final class NonEmptyStringTest extends TestCase
{
    public function testCanHaveAValue(): void
    {
        $validator = JSONTypes::string()->notEmpty();

        $this->assertTrue($validator->isValid('This is a test string!'));
    }

    public function testCanNotBeEmpty(): void
    {
        $validator = JSONTypes::string()->notEmpty();

        $this->assertFalse($validator->isValid(''));
        $this->assertFalse($validator->isValid(""));
    }
}
