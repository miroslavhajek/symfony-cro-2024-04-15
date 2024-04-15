<?php declare(strict_types=1);

namespace App\App\Homepage;

use App\CarOffer\CarOffer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{

    #[Route('/', methods: ['GET'], name: 'app_homepage')]
    public function homepage(): Response
    {
        /** @var \App\CarOffer\CarOffer[] $carOffers */
        $carOffers = [
            new CarOffer('Škoda Octava 1.8 TDI', 199999),
            new CarOffer('Fiat Panda', 79999),
        ];

        return $this->render('@App/homepage/homepage.html.twig', [
            'info' => 'This is a Symfony app',
            'rand' => random_int(1, 100),
            'numbers' => range(1, 10),
            'carOffers' => $carOffers,
        ]);
    }

}
