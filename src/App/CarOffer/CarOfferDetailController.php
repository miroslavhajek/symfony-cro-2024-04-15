<?php declare(strict_types=1);

namespace App\App\CarOffer;

use App\CarOffer\CarOffer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarOfferDetailController extends AbstractController
{

    #[Route('/nabidka/{id}', methods: ['GET'], name: 'car_offer_detail')]
    public function __invoke(
        CarOffer $carOffer,
        Request $request,
    ): Response
    {
        return $this->render(
            '@App/car-offer/detail.html.twig',
            [
                'carOffer' => $carOffer,
            ]
        );
    }

}
