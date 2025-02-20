<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 20; $i++) {
            $name = 'Product_'.md5(microtime());
            $price = rand(10, 1000);
            $stock_quantity = rand(2, 100);
            $product = new Product();
            $product->setName($name);
            $product->setPrice($price);
            $product->setStockQuantity($stock_quantity);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
