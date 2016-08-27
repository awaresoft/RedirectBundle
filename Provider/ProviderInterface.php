<?php

namespace Awaresoft\RedirectBundle\Provider;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Provider Interface
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
interface ProviderInterface
{
    /**
     * Validate request and create Response
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createResponse(Request $request);
}