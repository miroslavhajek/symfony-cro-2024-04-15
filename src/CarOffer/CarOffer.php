<?php declare(strict_types=1);

namespace App\CarOffer;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CarOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $price;

    public function __construct(string $name, int $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function updateData(
        string $name,
        int $price,
    ): void
    {
        $this->name = $name;
        $this->price = $price;
    }

}
