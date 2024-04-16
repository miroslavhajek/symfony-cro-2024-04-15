<?php declare(strict_types=1);

namespace App\Admin\CarOffer;

use App\App\Fixtures\CarOfferDatabaseFixture;
use App\WebTestCase;
use PHPUnit\Framework\Assert;

class CarOfferControllerTest extends WebTestCase
{
    public function testCarOffers(): void
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/admin/car-offer/');

        Assert::assertSame(200, $client->getResponse()->getStatusCode());
    }
    public function testAddCarOffers(): void
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/admin/car-offer/add');

        Assert::assertSame(200, $client->getResponse()->getStatusCode());
    }
    public function testEditCarOffers(): void
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/admin/car-offer/edit/' . CarOfferDatabaseFixture::$skodaFabia10TSI->getId());

        Assert::assertSame(200, $client->getResponse()->getStatusCode());
    }

}
