<?php declare(strict_types=1);

namespace App\CarOffer;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CarOfferUrlGenerator
{

    public function __construct(
        private UrlGeneratorInterface $urlGenerator
    )
    {
    }

    public function generateCarOfferEdit(CarOffer $carOffer): string
    {
        return $this->urlGenerator->generate('admin_car_offer_edit', [
            'id' => $carOffer->getId(),
        ]);
    }
}
