<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\Employee;
use Symfony\Component\Yaml\Yaml;

class LoadEmployee implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'Data/employee.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $employee = new Employee();
            $employee->setName($item['name']);
            $manager->persist($employee);
        }
        $manager->flush();

    }
}
