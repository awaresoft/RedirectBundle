<?php

namespace Awaresoft\RedirectBundle\Exception;

/**
 * Class UrlGenerationException
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class UrlGenerationException extends \Exception
{
    public function __construct($message, $code = 500, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
