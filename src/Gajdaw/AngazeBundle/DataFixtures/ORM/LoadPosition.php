<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\Position;
use Symfony\Component\Yaml\Yaml;

class LoadPosition implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/position.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $position = new Position();
            $position->setName($item['name']);
            $position->setTmp($item['tmp']);
            $position->setLorem($item['lorem']);
            $manager->persist($position);
        }
        $manager->flush();

    }
}
