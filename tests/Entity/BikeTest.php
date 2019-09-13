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

        $this->assertSame($string, $bike->__toString());
    }
}
