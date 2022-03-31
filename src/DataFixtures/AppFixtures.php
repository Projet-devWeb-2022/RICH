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
        $time = new \DateTime('now');


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

        //vehicle
        for ($i = 0; $i < 5; $i++) {
            $vehicle = new Vehicle();
            $vehicle->setName('Boeing '.$i);
            $vehicle->setType('aerien');
            $vehicle->setPriceDay(25+$i);

            $manager->persist($vehicle);
            $manager->flush();
        }

        //vehicleRental
        for ($i = 0; $i < 3; $i++) {
            $vehicleRent = new vehicleRental();
            $vehicleRent->setName('Location du vehicule');
            $vehicleRent->setNbPersonMax(5);
            $vehicleRent->setVehicle($vehicle);
            $vehicleRent->setPickingAddress('8 rue ici');
            $vehicleRent->setPickUpDate($date);
            $vehicleRent->setDescription('Vehicule incroyable');
            $vehicleRent->setDropOffDate($date);
            $vehicleRent->addDestination($destination);
            $vehicleRent->setIsAvailable(true);
            $vehicleRent->setPrice($vehicle->getPriceDay() * 2);

            $manager->persist($vehicleRent);
            $manager->flush();
        }

        //Travel
        for($i = 0; $i < 5; $i++){
            $flight = new Travel();
            $flight->addDestination($destination);
            $flight->setName('vol vers '.$destination->getCity());
            $flight->setPrice($i * 75 * 5);
            $flight->setNbPersonMax(5);
            $flight->setDescription('Une destination de reve');
            $flight->setVehicle($vehicle);
            $flight->setIsAvailable(true);
            $flight->setAirportDeparture('Aeroport Paris Charle de Gaulle');
            $flight->setAirportArrival('aeroport de '.$destination->getCity());
            $flight->setDateDeparture($date);
            $flight->setDateArrival($date);
            $flight->setDepartureTime($time);
            $flight->setArrivalTime($time);

            $manager->persist($flight);
            $manager->flush();
        }




        /**
        //Activity
        for($i = 0; $i < 10; $i++){
            $activity = new Activity();
            $activity->setName('Jetski 24'.$i);
            $activity->setDescription('incroyable moment');
            $activity->addDestination($destination);
            $activity->setIsAvailable(true);
            $activity->setNbPersonMax(4);
            $activity->setPrice(45 * 4);
            $activity->setAddress('port de marseille');
            $activity->setTypeOfActivity('nautique');
            $activity->setDate($date);
            $activity->setVehicle(null);

            $manager->persist($activity);
            $manager->flush();

        }
         **/

    }
}
