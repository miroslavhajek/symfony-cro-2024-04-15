<?php declare(strict_types=1);

namespace App\CarOffer;

use App\IntegrationDatabaseTestCase;
use PHPUnit\Framework\TestCase;

class CarOfferFacadeTest extends IntegrationDatabaseTestCase
{

    public function testCreateCarOffer()
    {
        $f = self::getContainer()->get(CarOfferFacade::class);
        $f->createCarOffer(
            'Foo',
            12345
        );

        self::markTestIncomplete('@tood!');
    }
}
