<?php

namespace Awaresoft\RedirectBundle\Exception;

/**
 * Class ResponseCodeNotFoundException
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class ResponseCodeNotFoundException extends \Exception
{
    const MESSAGE = 'Response code %s not found';

    /**
     * ResponseNotFoundException constructor.
     *
     * @param string $errorCode
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($errorCode, $code = 500, \Exception $previous = null)
    {
        parent::__construct(sprintf(self::MESSAGE, $errorCode), $code, $previous);
    }
}
