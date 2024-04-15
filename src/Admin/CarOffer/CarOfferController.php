<?php declare(strict_types=1);

namespace App\Admin\CarOffer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/car-offer', name: 'admin_car_offer_')]
class CarOfferController extends AbstractController
{

    #[Route('/add', name: 'add')]
    public function add(): Response
    {
        return $this->render('@Admin/car-offer/add.html.twig');
    }

}
