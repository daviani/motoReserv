<?php

namespace App\Tests\Entity;

use App\Entity\Bike;
use App\Entity\Tag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public function testNameGetterSetter()
    {
        $tag = new Tag();

        $this->assertNull($tag->getName());

        $tag->setName('foo');

        $this->assertSame('foo', $tag->getName());
    }

    public function testToString()
    {
        $tag = new Tag();

        $tag->setName('foo');
        $this->assertSame('foo', (string) $tag);
    }

    public function testBikeGetterSetter()
    {
        $tag = new Tag();

        $this->assertTrue($tag->getBikes()->isEmpty());

        $bike = new Bike();

        $this->assertTrue(!$tag->getBikes()->contains($bike));
        $tag->addBike($bike);
        $this->assertTrue($tag->getBikes()->contains($bike));

        $tag->removeBike($bike);

        $this->assertTrue(!$tag->getBikes()->contains($bike));
    }
}
