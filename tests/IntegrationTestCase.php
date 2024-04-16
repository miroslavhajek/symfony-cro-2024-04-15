<?php declare(strict_types = 1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class IntegrationTestCase extends KernelTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

}
