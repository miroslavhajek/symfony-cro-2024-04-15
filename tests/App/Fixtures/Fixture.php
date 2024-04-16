<?php declare(strict_types=1);

namespace App\App\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture as DoctrineFixture;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;

abstract class Fixture extends DoctrineFixture
{

    final public function load(ObjectManager $manager): void
    {
        if (!($manager instanceof EntityManager)) {
            throw new \Exception('Given instance is not ORM EntityManager');
        }
        $this->loadWithEntityManager($manager);
    }

    /**
     * Ensures that Fixtures get only EntityManager and not ObjectManager
     */
    abstract public function loadWithEntityManager(EntityManager $entityManager): void;

}
