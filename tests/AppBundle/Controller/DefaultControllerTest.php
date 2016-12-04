<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    // test set Shared Max Age
    /**
     * @group cache
     */
    public function testCachedContent()
    {
        $client = static::createClient();
        // Step 1: set value in cache reponse
        $crawler = $client->request('GET', '/cachedContent/test');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(3600, $client->getResponse()->getMaxAge());
        //$this->assertEquals(3600, $client->getResponse()->get);
        $firstCachedValue = $crawler->filter('h1')->text();

        // Step 2: check the value is always the same
        $crawler = $client->request('GET', '/cachedContent/test');
        $this->assertEquals(304, $client->getResponse()->getStatusCode());
        $this->assertContains($firstCachedValue, $crawler->filter('h1')->text());

        // Step 3: invalidate the cache by sending a purge request

        // Step 4: Remake a call to the api, check the value have changed
    }

    /*
    public function testCacheMustRevalidateHeader()
    {

    }

    public function testCacheInvalidation()
    {

    }

    public function testCachedESIResponseFragment()
    {

    }
*/
}
