<?php declare(strict_types=1);

namespace App\App\CarOffer;

use App\App\Fixtures\CarOfferDatabaseFixture;
use App\Inquiry\Inquiry;
use App\WebTestCase;
use PHPUnit\Framework\Assert;
use Symfony\Component\Mime\Email;

final class CarOfferDetailControllerTest extends WebTestCase
{

    public function testCarOfferDetail(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nabidka/' . CarOfferDatabaseFixture::$skodaFabia12TDI->getId());
        Assert::assertSame(200, $client->getResponse()->getStatusCode());

        Assert::assertSame('Škoda Fabia 1.2 TDI Ambition', $crawler->filter('h1')->first()->text());
        Assert::assertSame('499999 Kč', $crawler->filter('.test-price')->first()->text());
    }

    public function testInquiryFormCanBeSubmitted(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nabidka/' . CarOfferDatabaseFixture::$skodaFabia12TDI->getId());
        Assert::assertSame(200, $client->getResponse()->getStatusCode());

        $crawler = $client->submitForm('inquiry_form[submit]', [
            'inquiry_form[name]' => 'Josef Novák',
            'inquiry_form[email]' => 'josef.novak@example.com',
            'inquiry_form[phone]' => '',
            'inquiry_form[note]' => '',
        ]);

        self::assertRedirectsTo('/nabidka/1', 302, $client->getResponse());

        // verify inquiry in DB
        /** @var \App\Inquiry\Inquiry $inquiryInDb */
        $inquiryInDb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('inquiry')
            ->from(Inquiry::class, 'inquiry')
            ->andWhere('inquiry.email = :email')->setParameter('email', 'josef.novak@example.com')
            ->getQuery()
            ->getSingleResult();
        Assert::assertSame('Josef Novák', $inquiryInDb->getName());
    }
}
