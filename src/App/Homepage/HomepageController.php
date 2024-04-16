<?php declare(strict_types=1);

namespace App\App\Homepage;

use App\CarOffer\CarOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{

    #[Route('/', methods: ['GET'], name: 'app_homepage')]
    public function homepage(
        CarOfferRepository $carOfferRepository,
    ): Response
    {
        return $this->render('@App/homepage/homepage.html.twig', [
            'carOffers' => $carOfferRepository->fetchAllCarOffers(),
        ]);
    }

}
