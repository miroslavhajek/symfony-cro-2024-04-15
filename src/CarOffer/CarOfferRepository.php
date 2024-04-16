<?php declare(strict_types=1);

namespace App\CarOffer;

use Doctrine\ORM\EntityManagerInterface;

class CarOfferRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @return \App\CarOffer\CarOffer[]
     */
    public function fetchAllCarOffers(): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('carOffer')
            ->from(CarOffer::class, 'carOffer')
            ->addOrderBy('carOffer.name')
            ->getQuery()->getResult();
    }

    /**
     * @return \App\CarOffer\CarOffer[]
     */
    public function fetchSidebarCarOffers(): array
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('carOffer')
            ->from(CarOffer::class, 'carOffer')
            ->addOrderBy('carOffer.name')
            ->setMaxResults(3)
            ->getQuery()->getResult();
    }
}
