<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Students;

/**
 * @Doctrine\Bundle\FixturesBundle\Fixture 
 */
class StudentsFixture extends Fixture
{
    public function load(ObjectManager $manager, ): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i<50; $i++) {
            $student = new Students();
            $student->setFirstname($faker->firstName);
            $student->setName($faker->name);
            $student->setBirthDate($faker->dateTimeBetween($startDate = '-18 years', $endDate = '-6 years'));
            $student->setPlaceOfBirth($faker->country);
            $student->setParentPhone($faker->phoneNumber);
            $student->setAdress($faker->city);
            $student->setGeneraleAverage($faker->randomFloat($nbMaxDecimals = null, $min = 40.0, $max = 99.0));
        }


        $manager->flush();
    }
    public static function getGroups(): array
    {
        return ['students'];
    }
}
