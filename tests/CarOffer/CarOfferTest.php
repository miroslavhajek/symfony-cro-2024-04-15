<?php declare(strict_types=1);

namespace App\CarOffer;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CarOfferTest extends TestCase
{

    public function testCarOffer(): void
    {
        $carOffer = new CarOffer(
            'Škoda Octavia 1.6 TDI',
            199999,
        );

        Assert::assertSame('Škoda Octavia 1.6 TDI', $carOffer->getName());
        Assert::assertSame(199999, $carOffer->getPrice());
    }

    public function testUpdateData(): void
    {
        $carOffer = CarOfferFixture::createCarOffer();

        $carOffer->updateData(
            'Škoda Fabia 1.6 TDI',
            121000,
        );

        Assert::assertSame('Škoda Fabia 1.6 TDI', $carOffer->getName());
        Assert::assertSame(121000, $carOffer->getPrice());
    }

}
