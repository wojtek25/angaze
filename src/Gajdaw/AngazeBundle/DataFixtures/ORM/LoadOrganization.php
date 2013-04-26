<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\Organization;
use Symfony\Component\Yaml\Yaml;

class LoadOrganization implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
//        $filename =
//            __DIR__ .
//                DIRECTORY_SEPARATOR . '..' .
//                DIRECTORY_SEPARATOR . '..' .
//                DIRECTORY_SEPARATOR . 'Data/organization.yml';
//
//        $yml = Yaml::parse(file_get_contents($filename));
//        foreach ($yml as $item) {
//            $organization = new Organization();
//            $organization->setName($item['name']);
//            $organization->setCurator($item['curator']);
//            $organization->setTmp($item['tmp']);
//            $manager->persist($organization);
//        }
//        $manager->flush();

    }
}
