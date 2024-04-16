<?php declare(strict_types=1);

namespace App\App\Homepage;

use App\IntegrationDatabaseTestCase;
use App\WebTestCase;
use PHPUnit\Framework\Assert;

class HomepageControllerTest extends WebTestCase
{
    public function testHomepage(): void
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/');

        Assert::assertSame(200, $client->getResponse()->getStatusCode());

        Assert::assertSame('List of Car Offers', $crawler->filter('h1')->text());

        $carOffers = $crawler->filter('.test-car-offer');
        Assert::assertCount(2, $carOffers);
        Assert::assertSame(
            'Škoda Fabia 1.0 TSI Ambition',
            $carOffers->first()->filter('.test-name')->text()
        );
    }

}
