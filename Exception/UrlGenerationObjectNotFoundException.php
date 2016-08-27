<?php

namespace Awaresoft\RedirectBundle\Exception;

/**
 * Class UrlGenerationObjectNotFoundException
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class UrlGenerationObjectNotFoundException extends RedirectException
{
    const MESSAGE = 'Object %s not found';

    public function __construct($parameter, $code = 500, \Exception $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $parameter), $code, $previous);
    }
}
