<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController
{

    #[Route('/', methods: ['GET'], name: 'app_homepage')]
    public function homepage()
    {
        return new Response('<h1>Hello!</h1>');
    }

}
