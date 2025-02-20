<?php declare(strict_types=1);

namespace App\Admin\CarOffer;

use App\CarOffer\CarOffer;
use App\CarOffer\CarOfferFacade;
use App\CarOffer\CarOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/car-offer', name: 'admin_car_offer_')]
class CarOfferController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(
        CarOfferRepository $carOfferRepository,
    ): Response
    {
        $carOffers = $carOfferRepository->fetchAllCarOffers();

        return $this->render('@Admin/car-offer/index.html.twig', [
            'carOffers' => $carOffers,
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(
        Request $request,
        CarOfferFacade $carOfferFacade,
    ): Response
    {
        $carOfferRequest = new CarOfferRequest();
        $form = $this->createForm(CarOfferForm::class, $carOfferRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carOffer = $carOfferFacade->createCarOffer(
                $carOfferRequest->name,
                $carOfferRequest->price,
            );

            $this->addFlash('success', 'Car offer added successfully.');

            return $this->redirectToRoute('admin_car_offer_index');
        }

        return $this->render('@Admin/car-offer/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id<\d+>}', name: 'edit')]
    public function edit(
        CarOffer $carOffer,
        Request $request,
        CarOfferFacade $carOfferFacade,
    ): Response
    {
        $carOfferRequest = CarOfferRequest::fromCarOffer($carOffer);
        $form = $this->createForm(CarOfferForm::class, $carOfferRequest, [
            'is_update' => true,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carOfferFacade->updateCarOffer(
                $carOffer,
                $carOfferRequest->name,
                $carOfferRequest->price,
            );

            $this->addFlash('success', 'Car offer has been updated.');

            return $this->redirectToRoute('admin_car_offer_index');
        }

        return $this->render('@Admin/car-offer/edit.html.twig', [
            'carOffer' => $carOffer,
            'form' => $form,
        ]);
    }

}
