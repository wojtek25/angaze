<?php

namespace Gajdaw\AngazeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\AngazeBundle\Entity\SubjectType;
use Symfony\Component\Yaml\Yaml;

class LoadSubjectType implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/subjectType.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $subjectType = new SubjectType();
            $subjectType->setName($item['name']);
            $subjectType->setTmp($item['tmp']);
            $manager->persist($subjectType);
        }
        $manager->flush();

    }
}
