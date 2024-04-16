<?php declare(strict_types=1);

namespace App\App\CarOffer;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final class InquiryRequest
{
    #[Assert\NotBlank]
    public string $name;

    #[Assert\Email]
    public ?string $email = null;

    public ?string $phone = null;

    public ?string $note = null;

    #[Assert\Callback]
    public function validateContactInfo(ExecutionContextInterface $context)
    {
        if ($this->email === null && $this->phone === null) {
            $context
                ->buildViolation('E-mail or Phone required.')
                ->atPath('phone')
                ->addViolation();
        }
    }
}
