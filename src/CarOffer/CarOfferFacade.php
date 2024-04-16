<?php declare(strict_types=1);

namespace App\CarOffer;

use Doctrine\ORM\EntityManagerInterface;

class CarOfferFacade
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function createCarOffer(
        string $name,
        int $price,
    ): CarOffer
    {
        $carOffer = new CarOffer(
            $name,
            $price
        );

        $this->entityManager->persist($carOffer);
        $this->entityManager->flush();

        $this->emailSender->sendCarofferCreatedNotification($carOffer);

        return $carOffer;
    }
}
