<?php declare(strict_types = 1);

namespace App;

use App\App\Fixtures\UserFixture;
use App\User\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class WebTestCase extends KernelTestCase
{

    /**
     * @param string[] $options An array of options to pass to the createKernel class
     * @param string[] $server An array of server parameters
     */
    protected static function createClient(array $options = [], array $server = []): KernelBrowser
    {
        self::bootKernel($options);

        $container = self::$kernel->getContainer();
        self::assertNotNull($container);

        /** @var \Symfony\Bundle\FrameworkBundle\KernelBrowser $client */
        $client = $container->get('test.client');

        $client->setServerParameters($server);

        $client->disableReboot();

        return $client;
    }

    /**
     * @param string[] $options An array of options to pass to the createKernel class
     * @param string[] $server An array of server parameters
     */
    protected static function createAuthenticatedClient(User $user, array $options = [], array $server = []): KernelBrowser
    {
        $client = self::createClient($options, $server);

        // @see https://github.com/symfony/symfony/pull/32850
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());

        $container = self::$kernel->getContainer();
        self::assertNotNull($container);
        $session = $container->get('session');
        $session->set('_security_main', serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        return $client;
    }

    /**
     * @param string[] $options An array of options to pass to the createKernel class
     * @param string[] $server An array of server parameters
     */
    protected static function createAdminAuthenticatedClient(array $options = [], array $server = []): KernelBrowser
    {
        return self::createAuthenticatedClient(UserFixture::$admin, $options, $server);
    }

    protected function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $container = self::$kernel->getContainer();
        self::assertNotNull($container);

        /** @var \Symfony\Bundle\FrameworkBundle\KernelBrowser $client */
        $client = $container->get('test.client');

        IntegrationDatabaseTestCase::rebuildDatabase($client->getKernel());
    }

    protected function getEntityManager(): EntityManager
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = self::getContainer()->get(EntityManagerInterface::class);

        return $entityManager;
    }

    protected static function assertHtmlTitle(
        Crawler $crawler,
        string $expectedTitle
    ): void
    {
        $titleTag = $crawler->filter('head title');
        self::assertCount(1, $titleTag, 'One title tag expected');

        $title = $titleTag->text();
        self::assertSame(
            $expectedTitle,
            $title,
            'Incorrect title!'
        );
    }

    protected static function assertRedirectsTo(
        string $expectedRedirectUrl,
        int $expectedRedirectStatusCode,
        Response $response
    ): void
    {
        self::assertTrue(
            $response->isRedirection(),
            sprintf(
                'Response is not redirect (status code: %s)',
                $response->getStatusCode()
            )
        );

        self::assertSame(
            $expectedRedirectStatusCode,
            $response->getStatusCode(),
            'Unexpected redirect status code'
        );

        $locationHeader = $response->headers->get('Location');
        if (!is_string($locationHeader)) {
            throw new \Exception('Location header must be string');
        }
        self::assertTrue(
            $response->isRedirect($expectedRedirectUrl),
            sprintf(
                'Expected to redirect to "%s" but redirects to "%s"',
                $expectedRedirectUrl,
                $locationHeader
            )
        );
    }

}
