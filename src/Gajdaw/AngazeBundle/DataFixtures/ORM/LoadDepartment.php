<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\Department;
use Symfony\Component\Yaml\Yaml;

class LoadDepartment implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'Data/department.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $department = new Department();
            $department->setName($item['name']);
            $department->setShortcut($item['shortcut']);
            $department->setTmp($item['tmp']);
            $department->setLorem($item['lorem']);
            $manager->persist($department);
        }
        $manager->flush();

    }
}
