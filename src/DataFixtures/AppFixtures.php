<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i <20; $i++) {
            $product = new Product();
            $product->setName('test n'.$i);
            $product->setPrice($i);
            $product->setDescription('Hey i\'m the test n'.$i);
            $manager->persist($product);
        }
        

        $manager->flush();
    }
}
