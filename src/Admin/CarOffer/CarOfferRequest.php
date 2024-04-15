<?php declare(strict_types=1);

namespace App\Admin\CarOffer;

use Symfony\Component\Validator\Constraints as Assert;

class CarOfferRequest
{

    #[Assert\NotBlank()]
    #[Assert\Length(min: 10)]
    public string $name;

    #[Assert\NotBlank()]
    #[Assert\GreaterThanOrEqual(10000)]
    public int $price;

}
