<?php declare(strict_types=1);

namespace App\CarOffer;

use App\App\Fixtures\CarOfferDatabaseFixture;
use App\IntegrationDatabaseTestCase;
use PHPUnit\Framework\Assert;

class CarOfferUrlGeneratorTest extends IntegrationDatabaseTestCase
{

    public function testGenerator(): void
    {
        /** @var CarOfferUrlGenerator $carOfferUrlGenerator */
        $carOfferUrlGenerator = self::getContainer()->get(CarOfferUrlGenerator::class);

        Assert::assertSame(
            '/admin/car-offer/edit/2',
            $carOfferUrlGenerator->generateCarOfferEdit(
                CarOfferDatabaseFixture::$skodaFabia10TSI
            )
        );
    }

}
