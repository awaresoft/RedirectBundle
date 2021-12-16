<?php

namespace Awaresoft\RedirectBundle\UrlGenerator;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Generator Interface
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
interface UrlGeneratorInterface
{
    /**
     * Generate url
     *
     * @param Request $request
     * @param ContainerInterface $container
     *
     * @return string
     */
    public function generate(Request $request, ContainerInterface $container);
}
