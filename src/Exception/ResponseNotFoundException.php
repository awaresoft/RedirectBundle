<?php

namespace Awaresoft\RedirectBundle\Exception;

/**
 * Class ResponseNotFoundException
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class ResponseNotFoundException extends RedirectException
{
    const MESSAGE = 'Response not found';

    /**
     * ResponseNotFoundException constructor.
     *
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($code = 500, \Exception $previous = null)
    {
        parent::__construct(self::MESSAGE, $code, $previous);
    }
}
