<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Country;
use App\Entity\Destination;
use App\Entity\Hotel;
use App\Entity\Orders;
use App\Entity\Pack;
use App\Entity\Travel;
use App\Entity\User;
use App\Entity\Vehicle;

use App\Entity\VehicleRental;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Role\Role;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $date = new \DateTime('02/01/2022');


        //Pays
        for ($i = 0; $i < 5; $i++) {
            $pays = new Country();
            $pays->setName('Pays'.$i);
            $pays->setContinent('Continent'.$i);

            $manager->persist($pays);
            $manager->flush();
        }

        //Destination
        for ($i = 0; $i < 20; $i++) {
            $destination = new Destination();
            $destination->setCity('ville '.$i);
            $destination->setDetails('detail... ');
            $destination->setContry($pays);

            $manager->persist($destination);
            $manager->flush();
        }

        //users
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('email'.$i);
            $user->setPassword('password'.$i);
            $user->setRoles(array('ROLE_USER'));
            $user->setName('prenom');
            $user->setSurname('nom');
            $user->setAddress('adresse'.$i);

            $manager->persist($user);
            $manager->flush();
        }



    }
}
