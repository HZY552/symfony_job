<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueRepository::class)]
class Historique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $n_commande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $create_date = null;

    #[ORM\Column]
    private ?int $id_freelancer = null;

    #[ORM\Column]
    private ?int $buyer = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $obj = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $total_price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNCommande(): ?int
    {
        return $this->n_commande;
    }

    public function setNCommande(int $n_commande): static
    {
        $this->n_commande = $n_commande;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTimeInterface $create_date): static
    {
        $this->create_date = $create_date;

        return $this;
    }

    public function getIdFreelancer(): ?int
    {
        return $this->id_freelancer;
    }

    public function setIdFreelancer(int $id_freelancer): static
    {
        $this->id_freelancer = $id_freelancer;

        return $this;
    }

    public function getBuyer(): ?int
    {
        return $this->buyer;
    }

    public function setBuyer(int $buyer): static
    {
        $this->buyer = $buyer;

        return $this;
    }

    public function getObj(): ?string
    {
        return $this->obj;
    }

    public function setObj(string $obj): static
    {
        $this->obj = $obj;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->total_price;
    }

    public function setTotalPrice(string $total_price): static
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }
}
