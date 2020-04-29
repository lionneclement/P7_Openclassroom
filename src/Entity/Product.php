<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * 
 * @Hateoas\Relation("self",
 *      href = @Hateoas\Route(
 *          "api_find_product",
 *          parameters = {
 *              "id" = "expr(object.getId())"
 *          },
 *      absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups={"all"})
 * )
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"all"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"all","one"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"all","one"})
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Groups({"all","one"})
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
