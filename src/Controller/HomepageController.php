<?php declare(strict_types=1);

namespace App\Controller;

use App\CarOffer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{

    #[Route('/', methods: ['GET'], name: 'app_homepage')]
    public function homepage(): Response
    {
        /** @var CarOffer[] $carOffers */
        $carOffers = [
            new CarOffer('Škoda Octava 1.8 TDI', 199999),
            new CarOffer('Fiat Panda', 79999),
        ];

        return $this->render('homepage/homepage.html.twig', [
            'info' => 'This is a Symfony app',
            'rand' => random_int(1, 100),
            'numbers' => range(1, 10),
            'carOffers' => $carOffers,
        ]);
    }

}
