<?php declare(strict_types=1);

namespace App\CarOffer;

class CarOfferFixture
{
    public static function createCarOffer(): CarOffer
    {
        return new CarOffer(
            'Škoda Octavia 1.6 TDI',
            199999,
        );
    }
}
