<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Nounours;

class AppNounours extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $nounours = new Nounours();
        $nounours->setName('Nounours');
        $nounours->setSize('100cm');
        $nounours->setPrice('100');
        $manager->persist($nounours);
        $muppets = new Nounours();
        $muppets->setName('Muppets');
        $muppets->setSize('100cm');
        $muppets->setPrice('100');
        $manager->persist($muppets);
        $panda = new Nounours();
        $panda->setName('Panda');
        $panda->setSize('100cm');
        $panda->setPrice('100');
        $manager->persist($panda);

        $manager->flush();
    }
}
