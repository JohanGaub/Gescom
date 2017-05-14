<?php


namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GescomBundle\Entity\Product;
use Faker;
use GescomBundle\Entity\ProductSupplier;

const MAX_PRODUCTS = 500;


class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');
        $faker->seed(1234);
        for($nbproducts = 0 ; $nbproducts < MAX_PRODUCTS ; $nbproducts++)
        {
            $product = new Product();

            $product->setName($faker->unique()->words(2, true));
            $product->setDescription($faker->sentence(6, true));
            $product->setCategory($this->getReference("categories" . mt_rand(0,9)));

            $suppliersTotal          = mt_rand(1, 3);
            $supplierStartNumber    = mt_rand(0, LoadSupplierData::MAX_SUPPLIERS - $suppliersTotal);

            for($i = 1 ; $i < $suppliersTotal ; $i++){
                $productSupplier = new ProductSupplier();

                $productSupplier->setProduct($product);
                $productSupplier->setSupplier($this->getReference("suppliers_" . $supplierStartNumber));
                $supplierStartNumber++;

                $manager->persist($productSupplier);
            }
            $manager->persist($product);
                    }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }
}