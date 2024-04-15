<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{

    #[Route('/', methods: ['GET'], name: 'app_homepage')]
    public function homepage(): Response
    {
        return $this->render('homepage/homepage.html.twig');
    }

}
