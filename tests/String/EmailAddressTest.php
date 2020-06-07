<?php

declare(strict_types=1);

use JanLucaKlees\JSONTypes;
use PHPUnit\Framework\TestCase;


final class EmailAddressTest extends TestCase
{
    public function testCanHaveAValue(): void
    {
        $validator = JSONTypes::string()->isEmailAddress();

        $this->assertTrue($validator->isValid('email@janlucaklees.de'));
    }

    public function testCanNotBeEmpty(): void
    {
        $validator = JSONTypes::string()->isEmailAddress();

        $this->assertFalse($validator->isValid(''));
        $this->assertFalse($validator->isValid(""));
    }

    public function testRequiresATld(): void
    {
        $validator = JSONTypes::string()->isEmailAddress();

        $this->assertFalse($validator->isValid('email@janlucaklees'));
    }

    public function testCanNotBeInvalid(): void
    {
        $validator = JSONTypes::string()->isEmailAddress();

        $this->assertFalse($validator->isValid('Not an email address.'));
        $this->assertFalse($validator->isValid('email@janlucaklees'));
    }

    public function testCanNotContainSpaces(): void
    {
        $validator = JSONTypes::string()->isEmailAddress();

        $this->assertFalse($validator->isValid('e mail@janlucaklees.de'));
        $this->assertFalse($validator->isValid('email @janlucaklees.de'));
        $this->assertFalse($validator->isValid('email@janluca klees.de'));
    }
}
