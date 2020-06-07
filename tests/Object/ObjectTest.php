<?php

declare(strict_types=1);

use JanLucaKlees\JSONTypes;
use PHPUnit\Framework\TestCase;


final class ObjectTest extends TestCase
{
    public function testCanHaveAValue(): void
    {
        $validator = JSONTypes::object([
            'name' => JSONTypes::string()
        ]);

        $this->assertTrue($validator->isValid((object) [
            'name' => 'Jan-Luca Klees'
        ]));
    }

    public function testCanBeEmpty(): void
    {
        $validator = JSONTypes::object();

        $this->assertTrue($validator->isValid((object) []));
        $this->assertTrue($validator->isValid((object) [
            'name' => 'Jan-Luca Klees'
        ]));


        $validator = JSONTypes::object([]);

        $this->assertTrue($validator->isValid((object) []));
        $this->assertTrue($validator->isValid((object) [
            'name' => 'Jan-Luca Klees'
        ]));
    }

    public function testCanBeNested(): void
    {
        $validator = JSONTypes::object([
            'person' => JSONTypes::object([
                'name' => JSONTypes::string()
            ])
        ]);

        $this->assertTrue($validator->isValid((object) [
            'person' => (object) [
                'name' => 'Jan-Luca Klees'
            ]
        ]));
    }

    public function testCanRequireAProperty(): void
    {
        $validator = JSONTypes::object((object) [
            'name'  => JSONTypes::string()->isRequired()
        ]);

        $this->assertTrue($validator->isValid((object) [
            'name' => 'Jan-Luca Klees'
        ]));
        $this->assertTrue($validator->isValid((object) [
            'name' => 'Jan-Luca Klees',
            'email' => 'email@janlucaklees.de'
        ]));

        $this->assertFalse($validator->isValid((object) []));
        $this->assertFalse($validator->isValid((object) [
            'email' => 'email@janlucaklees.de'
        ]));
    }

    public function testCanNotBeNull(): void
    {
        $validator = JSONTypes::object([
            'name' => JSONTypes::string()
        ]);

        $this->assertFalse($validator->isValid(null));


        $validator = JSONTypes::object();

        $this->assertFalse($validator->isValid(null));
    }

    public function testCanNotBeAnArray(): void
    {
        $validator = JSONTypes::object([
            'name' => JSONTypes::string()
        ]);

        $this->assertFalse($validator->isValid([]));
        $this->assertFalse($validator->isValid(array()));
        $this->assertFalse($validator->isValid([
            'name' => 'Jan-Luca Klees'
        ]));


        $validator = JSONTypes::object();

        $this->assertFalse($validator->isValid([]));
        $this->assertFalse($validator->isValid(array()));
        $this->assertFalse($validator->isValid([
            'name' => 'Jan-Luca Klees'
        ]));
    }
}
