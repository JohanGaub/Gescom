<?php


namespace GescomBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Calculator\Luhn;
use Faker\Generator;
use Faker\Provider\fr_FR\Company;
use GescomBundle\Entity\Supplier;

class LoadSupplierData extends AbstractFixture implements OrderedFixtureInterface
{

    const MAX_SUPPLIERS = 100;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        $faker->seed(1234);

        for($nbsuppliers = 0 ; $nbsuppliers < self::MAX_SUPPLIERS ; $nbsuppliers++)
        {
            $supplier = new Supplier();

            $supplier->setName($faker->unique()->company);
            $supplier->setAddress($faker->address);
            $supplier->setEmail($faker->unique()->companyEmail);
            $supplier->setPostcode($faker->postcode);
            $supplier->setTown($faker->city);
            $supplier->setSiret($faker->siret);
            $supplier->setWebsite($faker->url);
            $supplier->setDeliveryDelay(mt_rand(1, 30));
            $supplier->setScore($faker->numberBetween(1, 5));

            $manager->persist($supplier);

            $this->setReference("Suppliers" . $nbsuppliers, $supplier);
        }
        $manager->flush();
    }


    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }


}