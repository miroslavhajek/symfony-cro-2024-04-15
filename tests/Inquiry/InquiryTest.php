<?php declare(strict_types=1);

namespace App\Inquiry;

use App\CarOffer\CarOfferFixture;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class InquiryTest extends TestCase
{

    public function testCreateInquiry(): void
    {
        $inquiry = new Inquiry(
            CarOfferFixture::createCarOffer(),
            'John Doe',
            'john.doe@example.com',
            null,
            '',
        );

        Assert::assertSame('John Doe', $inquiry->getName());
        Assert::assertSame('john.doe@example.com', $inquiry->getEmail());
    }

}
