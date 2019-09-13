<?php

namespace App\Tests\Entity;

use App\Entity\Bike;
use PHPUnit\Framework\TestCase;

class BikeTest extends TestCase
{
    public function testBikeToString()
    {
        $bike = (new Bike())
            ->setBrand('Foo')
            ->setModel('Bar')
            ->setMatriculation('AZERTY')
        ;

        $bike = new Bike();
        $bike->setBrand('Foo');
        $bike->setModel('Bar');
        $bike->setMatriculation('AZERTY');

        $string = 'Foo Bar (AZERTY)';
        $realString = $bike->__toString();

        $this->assertInternalType('string', $realString);
        $this->assertSame($string, $realString);
    }

    public function testStatusTransKey()
    {
        $bike = new Bike();

        $this->assertSame('bike.entity.status.default.label', $bike->getStatusTransKey());

        $bike->setStatus(1);
        $this->assertSame('bike.entity.status.available.label', $bike->getStatusTransKey());

        // ... 2 3 4
        $bike->setStatus(5);
        $this->assertSame('bike.entity.status.default.label', $bike->getStatusTransKey());
    }
}
