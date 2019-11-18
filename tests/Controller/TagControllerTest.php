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

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class TagControllerTest
 *
 * @author Benjamin Georgeault
 */
class TagControllerTest extends WebTestCase
{
    public function testIndexRedirect()
    {
        $client = static::createClient();

        $client->request('GET', '/tag');
        $response = $client->getResponse();

        $this->assertEquals($response->getStatusCode(), 301);
    }

    public function testIndexOk()
    {
        $client = static::createClient();

        $client->request('GET', '/tag/');
        $response = $client->getResponse();

        $this->assertEquals($response->getStatusCode(), 200);
    }

    public function testIndexTable()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tag/');

        $rows = $crawler->filter('table.table > tbody > tr');

        $container = $client->getContainer();

        /** @var EntityManagerInterface $em */
        $em = $container->get('doctrine.orm.entity_manager');
        /** @var TagRepository $tagRepo */
        $tagRepo = $em->getRepository(Tag::class);

        $this->assertCount($tagRepo->count([]), $rows);
    }
}
