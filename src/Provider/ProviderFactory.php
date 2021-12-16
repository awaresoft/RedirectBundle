<?php

namespace Awaresoft\RedirectBundle\Provider;

use Awaresoft\RedirectBundle\Exception\RedirectException;
use Awaresoft\RedirectBundle\Exception\ResponseException;
use Awaresoft\RedirectBundle\Exception\ResponseNotFoundException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Provider Factory
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class ProviderFactory
{
    const SERVICE_PREFIX = 'awaresoft.redirect.provider';

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * ProviderFactory constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Create factory
     *
     * @param $type
     *
     * @return ProviderInterface|AbstractProvider
     */
    public function create($type)
    {
        $type = str_replace(self::SERVICE_PREFIX . '.', '', $type);

        return $this->container->get(sprintf('%s.%s', self::SERVICE_PREFIX, $type));
    }

    /**
     * Chain validator helps to find redirect url by ordered providers
     *
     * @param Request $request
     *
     * @return Response
     * @throws \Exception
     */
    public function chainValidator(Request $request)
    {
        $response = null;

        foreach ($this->container->getParameter('awaresoft.redirect.providers') as $providerType) {
            try {
                $provider = $this->create($providerType);
                $response = $provider->createResponse($request);
            } catch (RedirectException $e) {

            }
        }

        if (!$response) {
            return;
        }

        return $response;
    }
}
