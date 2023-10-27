<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setQuantity(mt_rand(1,25));
            $product->setPriceNet(mt_rand(100,100000));
            $product->setPriceGross(mt_rand(100,100000));
            $product->setVatRate(mt_rand(0,230));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
