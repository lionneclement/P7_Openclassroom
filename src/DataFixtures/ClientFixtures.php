<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $client = new Client();
        $client->setEmail('client@gmail.com');
        $client->setName('client');
        $client->setRoles(['ROLE_CLIENT']);

        $encoded = $this->encoder->encodePassword($client, 'password');
        $client->setPassword($encoded);

        $manager->persist($client);
        $manager->flush();
    }
}
