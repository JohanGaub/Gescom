<?php


namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GescomBundle\Entity\Product;
use Faker;




class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create();

        $productData = new Product();
        $productData->setName('bullshit');
        $productData->setDescription('big');

        $manager->persist($productData);
        $manager->flush();

        $this->addProduct('product-reference', $productData);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 4;
    }
}