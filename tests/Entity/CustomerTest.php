<?php

/*
 * This file is part of the adrec-pilotage package.
 *
 * (c) Benjamin Georgeault <https://www.drosalys-web.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Entity;

use App\Entity\Customer;
use PHPUnit\Framework\TestCase;

/**
 * Class CustomerTest
 *
 * @author Benjamin Georgeault
 */
class CustomerTest extends TestCase
{
    public function testToString()
    {
        $customer = new Customer();
        $customer->setFirstName('Foo');
        $customer->setLastName('Bar');

        $string = (string) $customer;

        $this->assertEquals($customer, 'Foo Bar');
    }
}
