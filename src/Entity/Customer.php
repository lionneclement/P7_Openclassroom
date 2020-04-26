<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @UniqueEntity("email")
 * 
 * @Hateoas\Relation("self",
 *      href = @Hateoas\Route(
 *          "api_find_one_customer",
 *          parameters = {
 *              "id" = "expr(object.getId())"
 *          },
 *      absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups={"all"})
 * )
 * @Hateoas\Relation("delete",
 *      href = @Hateoas\Route(
 *          "api_delete_one_customer",
 *          parameters = {
 *              "id" = "expr(object.getId())"
 *          },
 *      absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups={"all","one"})
 * )
 */
class Customer
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Serializer\Groups({"all","one"})
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\client", inversedBy="customers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $clientId;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClientId(): ?client
    {
        return $this->clientId;
    }

    public function setClientId(?client $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }
}
