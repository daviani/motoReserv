<?php

/*
 * This file is part of the adrec-pilotage package.
 *
 * (c) Benjamin Georgeault <https://www.drosalys-web.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BikeControllerTest
 *
 * @author Benjamin Georgeault
 */
class BikeControllerTest extends WebTestCase
{
    public function testIndexAvailable()
    {
        $client = static::createClient();

        $client->request('GET', '/bike/');
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $client->request('POST', '/bike/');
        $response = $client->getResponse();

        $this->assertEquals(405, $response->getStatusCode());
    }

    public function testIndexTitle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/bike/');

        $h1 = $crawler->filter('h1');

        $this->assertCount(1, $h1);
    }
}
