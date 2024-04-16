<?php declare(strict_types=1);

namespace App\App\Fixtures;

use App\Brand\Brand;
use App\CarOffer\CarOffer;
use Doctrine\ORM\EntityManager;

final class CarOfferDatabaseFixture extends Fixture
{

    /** @var \App\CarOffer\CarOffer */
    public static $skodaFabia12TDI;
    public const SKODA_FABIA_12TDI = 'skoda-fabia-12TDI';

    /** @var \App\CarOffer\CarOffer */
    public static $skodaFabia10TSI;
    public const SKODA_FABIA_10TSI = 'skoda-fabia-10TSI';

    public function loadWithEntityManager(EntityManager $entityManager): void
    {
        self::$skodaFabia12TDI = new CarOffer(
            'Škoda Fabia 1.2 TDI Ambition',
            499999,
        );
        $this->addReference(self::SKODA_FABIA_12TDI, self::$skodaFabia12TDI);
        $entityManager->persist(self::$skodaFabia12TDI);

        self::$skodaFabia10TSI = new CarOffer(
            'Škoda Fabia 1.0 TSI Ambition',
            299999,
        );
        $this->addReference(self::SKODA_FABIA_10TSI, self::$skodaFabia10TSI);
        $entityManager->persist(self::$skodaFabia10TSI);

        $entityManager->flush();
    }

}
