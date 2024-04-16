<?php declare(strict_types=1);

namespace App\Inquiry;

use App\CarOffer\CarOffer;
use Doctrine\ORM\EntityManagerInterface;

final class InquiryFacade
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function makeInquiry(
        CarOffer $carOffer,
        string $name,
        ?string $email,
        ?string $phone,
        ?string $note
    ): Inquiry
    {
        $inquiry = new Inquiry(
            $carOffer,
            $name,
            $email,
            $phone,
            $note,
        );

        $this->entityManager->persist($inquiry);
        $this->entityManager->flush();

        return $inquiry;
    }
}
