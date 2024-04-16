<?php declare(strict_types=1);

namespace App\App\Homepage;

use PHPUnit\Framework\Assert;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/');

        Assert::assertSame(200, $client->getResponse()->getStatusCode());

        Assert::assertSame('List of Car Offers', $crawler->filter('h1')->text());
    }

}
