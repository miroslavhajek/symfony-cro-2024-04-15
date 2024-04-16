<?php declare(strict_types=1);

namespace App\CarOffer\Twig;

use App\CarOffer\CarOfferRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CarOfferTwigExtension extends AbstractExtension
{


    public function __construct(
        private CarOfferRepository $carOfferRepository,
    )
    {
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('carOffersSidebar', [$this, 'getCarOfferSidebar']),
        ];
    }

    public function getCarOfferSidebar(): array
    {
         return $this->carOfferRepository->fetchSidebarCarOffers();
    }


}
