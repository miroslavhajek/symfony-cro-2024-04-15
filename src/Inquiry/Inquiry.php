<?php declare(strict_types=1);

namespace App\Inquiry;

use App\CarOffer\CarOffer;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Inquiry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: CarOffer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private CarOffer $carOffer;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $email;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $phone;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $note;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct(
        CarOffer $carOffer,
        string $name,
        ?string $email,
        ?string $phone,
        ?string $note,
    )
    {
        $this->carOffer = $carOffer;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->note = $note;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarOffer(): CarOffer
    {
        return $this->carOffer;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
