<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\CourseType;
use Symfony\Component\Yaml\Yaml;

class LoadCourseType implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/courseType.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $courseType = new CourseType();
            $courseType->setName($item['name']);
            $courseType->setTmp($item['tmp']);
            $manager->persist($courseType);
        }
        $manager->flush();

    }
}
