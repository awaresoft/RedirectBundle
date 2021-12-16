<?php

namespace Awaresoft\RedirectBundle\Provider;

use Awaresoft\RedirectBundle\Exception\ResponseCodeNotFoundException;
use Doctrine\ORM\EntityManager;
use Sonata\PageBundle\Site\SiteSelectorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Abstract Provider
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
abstract class AbstractProvider implements ProviderInterface
{
    /**
     * Entity class
     *
     * @var string
     */
    protected $class;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var SiteSelectorInterface
     */
    protected $siteSelector;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * AbstractProvider constructor.
     *
     * @param $class
     * @param ContainerInterface $container
     */
    public function __construct($class, ContainerInterface $container)
    {
        $this->class = $class;
        $this->em = $container->get('doctrine')->getManager();
        $this->siteSelector = $container->get('sonata.page.site.selector');
        $this->container = $container;
    }

    /**
     * Create domain redirect
     *
     * @param string $domainFrom
     * @param string $domainTo
     * @param string $pathFrom
     * @param string $pathTo
     * @param int $code
     * @param \DateTime|null $validTo
     * @param \DateTime|null $validFrom
     *
     * @throws \Exception
     */
    public function createDomain($domainFrom, $domainTo, $pathFrom, $pathTo, $code, \DateTime $validTo = null, \DateTime $validFrom = null)
    {
        throw new \Exception('This provider is not supported for selected class');
    }

    /**
     * Create url redirect
     *
     * @param string $urlFrom
     * @param string $urlTo
     * @param int $code
     * @param \DateTime $validTo
     * @param \DateTime $validFrom
     *
     * @throws \Exception
     */
    public function createUrl($urlFrom, $urlTo, $code, \DateTime $validTo = null, \DateTime $validFrom = null)
    {
        throw new \Exception('This provider is not supported for selected class');
    }

    /**
     * Create error redirect
     *
     * @param string $url
     * @param int $code
     * @param string $message
     * @param \DateTime $validTo
     * @param \DateTime $validFrom
     *
     * @throws \Exception
     */
    public function createError($url, $code, $message = null, \DateTime $validTo = null, \DateTime $validFrom = null)
    {
        throw new \Exception('This provider is not supported for selected class');
    }

    /**
     * Add extra features before save
     *
     * @param ProviderInterface $provider
     *
     * @return ProviderInterface
     */
    protected function preSave(ProviderInterface $provider)
    {
        return $provider;
    }

    /**
     * Save created provider
     *
     * @param ProviderInterface $provider
     * @param bool $flush
     */
    protected function save(ProviderInterface $provider, $flush = true)
    {
        $this->em->persist($provider);

        if ($flush) {
            $this->em->flush($provider);
        }
    }

    /**
     * Validate if response code is correct
     *
     * @param $code
     *
     * @throws ResponseCodeNotFoundException
     */
    protected function validateCode($code)
    {
        $class = new \ReflectionClass(Response::class);

        if (!in_array($code, $class->getConstants())) {
            throw new ResponseCodeNotFoundException($code);
        }
    }
}
