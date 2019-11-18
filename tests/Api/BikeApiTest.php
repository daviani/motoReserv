<?php

/*
 * This file is part of the adrec-pilotage package.
 *
 * (c) Benjamin Georgeault <https://www.drosalys-web.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BikeApiTest
 *
 * @author Benjamin Georgeault
 */
class BikeApiTest extends WebTestCase
{
    public function testCollectionGet()
    {
        $client = static::createClient();

        $client->request('GET', '/api/bikes', [], [], [
            'HTTP_ACCEPT' => 'text/txt,application/ld+json',
        ]);

        $response = $client->getResponse();

        $type = explode(';', $response->headers->get('Content-Type'))[0];

        $this->assertSame('application/ld+json', $type);

        $arrayOfBikes = json_decode($response->getContent(), true);

        $this->assertCount(30, $arrayOfBikes['hydra:member']);
    }
}
