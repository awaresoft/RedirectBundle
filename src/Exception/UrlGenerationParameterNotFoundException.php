<?php

namespace Awaresoft\RedirectBundle\Exception;

/**
 * Class UrlGenerationParameterNotFoundException
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class UrlGenerationParameterNotFoundException extends RedirectException
{
    const MESSAGE = 'Parameter %s not found';

    public function __construct($parameter, $code = 500, \Exception $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $parameter), $code, $previous);
    }
}
