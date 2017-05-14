<?php


namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use GescomBundle\Entity\Category;


class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR'); // Faker\Factory can take a locale as an argument, to return localized data. If no localized provider is found, the factory fallbacks to the default locale (en_US)
        $faker->seed(1234); // to get always the same generated data

        $categoriesName = [
            "PC de bureau",
            "PC portable",
            "Tablettes",
            "Smartphone",
            "Imprimante",
            "Moniteur",
            "Consommables",
            "Réseau",
            "Connectique"
        ];

        // for each category indexed
        foreach ($categoriesName as $key => $categoryName){
            // create new Category entity
            $category = new Category();
            // ...with every properties expected
            $category->setName($categoryName); //
            $category->setDescription($faker->sentence( 6, true));
            // we persist what we've created
            $manager->persist($category);
            // to set the reference of each category with the index
            $this->setReference("categories" . $key, $category);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}