<?php


namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;
use GescomBundle\Entity\Category;
use Faker;




class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();
        $insertedPKs = [];

        $populator = new Populator($faker);
        $populator->addEntity('GescomBundle:Category', 10);
        $populator->addEntity('GescomBundle:Supplier', 10);
        $populator->addEntity('GescomBundle:Product', 10);
        $populator->addEntity('GescomBundle:ProductSupplier', 10);
        $insertedPKs = $populator->execute();
        $manager->persist($populator);

        $manager->flush();


    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 4;
    }
}