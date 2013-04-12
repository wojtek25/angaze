<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\Room;
use Symfony\Component\Yaml\Yaml;

class LoadRoom implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
                $filename =
                        __DIR__ .
                                DIRECTORY_SEPARATOR . '..' .
                                DIRECTORY_SEPARATOR . '..' .
                                DIRECTORY_SEPARATOR . 'Data/room.yml';

                $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
                        $room = new Room();
                        $room->setName($item['name']);
                        $room->setTmp($item['tmp']);
                        $manager->persist($room);
        }
        $manager->flush();

    }
}
