<?php declare(strict_types = 1);

namespace App;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpKernel\KernelInterface;

abstract class IntegrationDatabaseTestCase extends \App\IntegrationTestCase
{

    /** @var bool */
    private static $dbInitDone = false;

    protected function setUp(): void
    {
        parent::setUp();
        self::rebuildDatabase(self::$kernel);
    }

    public static function rebuildDatabase(KernelInterface $kernel): void
    {
        self::initDatabase($kernel);

        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = self::getContainer()->get(EntityManagerInterface::class);

        /** @var \Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader $loader */
        $loader = self::getContainer()->get('test.doctrine.fixtures.loader');

        $purger = new ORMPurger();
        $executor = new ORMExecutor($entityManager, $purger);
        $executor->execute($loader->getFixtures());
    }

    private static function initDatabase(KernelInterface $kernel): void
    {
        if (self::$dbInitDone) {
            return;
        }

        $application = new Application($kernel);
        $application->setAutoExit(false);

        self::runCommand($application, 'doctrine:database:create', [
            '--if-not-exists' => true,
        ]);
        self::runCommand($application, 'doctrine:schema:drop', [
            '--full-database' => true,
            '--force' => true,
        ]);
        self::runCommand($application, 'doctrine:schema:create');

        self::$dbInitDone = true;
    }

    /**
     * @param mixed[] $arguments key value array of arguments
     */
    public static function runCommand(Application $application, string $command, array $arguments = []): int
    {
        $arguments['--env'] = 'test';
        $arguments = array_merge(['command' => $command], $arguments);

        $output = new BufferedOutput(BufferedOutput::VERBOSITY_VERY_VERBOSE);

        $return = $application->run(
            new ArrayInput($arguments),
            $output
        );

        if ($return !== 0) {
            throw new \Exception((string) json_encode($output->fetch()));
        }

        return $return;
    }

    protected function getEntityManager(): EntityManager
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = self::getContainer()->get(EntityManagerInterface::class);

        return $entityManager;
    }

}
