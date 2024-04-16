<?php declare(strict_types=1);

namespace App\App\CarOffer;

use App\CarOffer\CarOffer;
use App\CarOffer\CarOfferRepository;
use App\Inquiry\InquiryFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarOfferDetailController extends AbstractController
{

    #[Route('/nabidka/{id}', methods: ['GET', 'POST'], name: 'car_offer_detail')]
    public function __invoke(
        CarOffer $carOffer,
        //InquiryFacade $inquiryFacade,
        Request $request,
    ): Response
    {
        $inquryRequest = new InquiryRequest();
        $inquiryForm = $this->createForm(InquiryForm::class, $inquryRequest);
        $inquiryForm->handleRequest($request);

        if ($inquiryForm->isSubmitted() && $inquiryForm->isValid()) {
            dd($inquryRequest);
            /*$inquiry = $inquiryFacade->makeInquiry(
                $carOffer,
                $inquryRequest->name,
                $inquryRequest->email,
                $inquryRequest->phone,
                $inquryRequest->note,
            );*/
            $this->addFlash('success', 'Inquiry submitted');

            return $this->redirectToRoute('car_offer_detail', [
                'id' => $carOffer->getId(),
            ]);
        }

        return $this->render(
            '@App/car-offer/detail.html.twig',
            [
                'carOffer' => $carOffer,
                'inquiryForm' => $inquiryForm->createView(),
            ]
        );
    }

}
