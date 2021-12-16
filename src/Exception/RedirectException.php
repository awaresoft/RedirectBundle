<?php

namespace Awaresoft\RedirectBundle\Exception;

/**
 * Class RedirectException
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class RedirectException extends \Exception
{
    public function __construct($message, $code = 500, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
