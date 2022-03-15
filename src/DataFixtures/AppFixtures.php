<?php

namespace App\DataFixtures;

use App\Entity\Destination;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $destination = new Destination();
            $destination->setVille('ville '.$i);
            $destination->setPays('pays '.$i);
            $destination->setContinentPays('continent '.$i);
            $destination->setDetails('detail... ');
            $destination->setPays('pays '.$i);
            $destination->setPrix(mt_rand(10, 100));
            $manager->persist($destination);
        }

        $manager->flush();
    }
}
