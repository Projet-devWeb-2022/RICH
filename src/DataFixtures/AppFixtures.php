<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Destination;
use App\Entity\Order;
use App\Entity\Pack;
use App\Entity\Stays;
use App\Entity\Travel;
use App\Entity\User;
use App\Entity\Vehicle;

use App\Entity\VehicleRental;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Destination
        for ($i = 0; $i < 20; $i++) {
            $destination = new Destination();
            $destination->setVille('ville '.$i);
            $destination->setDetails('detail... ');

            $manager->persist($destination);
        }
        //Activity
        for ($i = 0; $i < 5; $i++) {
            $activity = new Activity();
            $activity->setlabel('Acitivite'.$i);
            $activity->setPrice(mt_rand(10, 100));
            $activity->setIsAvailable(true);
            $activity->setDescription('detail concernant ... ');
            $activity->setNbPeopleMax(mt_rand(1,10));
            $activity->setTypeActivity('type'.$i);
            $activity->setDate(\DateTime);
            $activity->setAdressActivity('adresse'.$i);

            $manager->persist($activity);
        }
        //Stays
        for ($i = 0; $i < 5; $i++) {
            $stay = new Stays();
            $stay->setlabel('Logement'.$i);
            $stay->setPrice(mt_rand(10, 100));
            $stay->setIsAvailable(true);
            $stay->setDescription('detail concernant ... ');
            $stay->setNbPeopleMax(mt_rand(1,10));
            $stay->setTypeLogement('type'.$i);
            $stay->setDate(\DateTime);
            $stay->setAdress('adresse'.$i);

            $manager->persist($stay);
        }
        //Pays
        for ($i = 0; $i < 5; $i++) {
            $pays = new Pays();
            $pays->setName('Pays'.$i);
            $pays->setContinent('Continent'.$i);

            $manager->persist($pays);
        }
        //orderRecap
        for ($i = 0; $i < 5; $i++) {
            $orderRecap = new Facture();
            $orderRecap ->setDate(\DateTime);
            $orderRecap ->setAmount(mt_rand(1,10));
            $orderRecap ->setPaimentMethod('Methode'.$i);
            $orderRecap ->setFacturationAdress('Adresse'.$i);

            $manager->persist($orderRecap);
        }

        //Vehicule
        for ($i = 0; $i < 5; $i++) {
            $vehicule = new Vehicule();
            $vehicule->setName('nom'.$i);
            $vehicule->setType('type'.$i);
            $vehicule->setPrice(mt_rand(1,10));

            $manager->persist($vehicule);
        }
        //Travel
        for ($i = 0; $i < 5; $i++) {
            $travel = new Travel();
            $travel->setlabel('Voyage'.$i);
            $travel->setPrice(mt_rand(10, 100));
            $travel->setIsAvailable(true);
            $travel->setDescription('detail concernant ... ');
            $travel->setNbPeopleMax(mt_rand(1,10));
            $travel->setAirportDeparture('airport'.$i);
            $travel->setAirportArrival('airport'.$i);
            $travel->setDateDeparture(\DateTime);
            $travel->setDateArrival(\DateTime);
            $travel->setVehicule($vehicule);

            $manager->persist($travel);
        }
        //VehicleRental
        for ($i = 0; $i < 5; $i++) {
            $vehicleRental = new VehicleRental();
            $vehicleRental->setlabel('Voyage'.$i);
            $vehicleRental->setPrice(mt_rand(10, 100));
            $vehicleRental->setIsAvailable(true);
            $vehicleRental->setDescription('detail concernant ... ');
            $vehicleRental->setNbPeopleMax(mt_rand(1,10));
            $vehicleRental->setTypeVehicul('Vehicule'.$i);
            $vehicleRental->setDropOffDate(\DateTime);
            $vehicleRental->setPickUpLocation(\DateTime);
            $vehicleRental->setVehicule($vehicule);

            $manager->persist($vehicleRental);
        }

        //Pack
        for ($i = 0; $i < 5; $i++) {
            $pack = new Pack();
            $pack->setlabel('Voyage'.$i);
            $pack->setPrice(mt_rand(10, 100));
            $pack->setIsAvailable(true);
            $pack->setDescription('detail concernant ... ');
            $pack->setNbPeopleMax(mt_rand(1,10));

            $manager->persist($pack);
        }
        //Commande
        for ($i = 0; $i < 5; $i++) {
            $commande = new Order();
            $commande->setAmount(mt_rand(10, 100));
            $commande->setDate(\DateTime);
            $commande->setPack($pack);

            $manager->persist($commande);
        }

        //users
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail('email'.$i);
            $user->setNom('nom'.$i);
            $user->setPrenom('prenom'.$i);
            $user->setPassword('password'.$i);
            $user->setRoles('role'.$i);
            $user->setAdresse('adresse'.$i);

            $manager->persist($commande);
        }
        $manager->flush();
    }
}
