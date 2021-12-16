<?php

namespace Awaresoft\RedirectBundle\Exception;

/**
 * Class EntityParameterIsMissingException
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class EntityParameterIsMissingException extends \Exception
{
    const MESSAGE = 'Entity parameters are missing: %s';

    /**
     * ResponseNotFoundException constructor.
     *
     * @param string|array $parameters
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($parameters, $code = 500, \Exception $previous = null)
    {
        if (is_array($parameters)) {
            $parameters = implode(', ' . $parameters);
        }

        parent::__construct(sprintf(self::MESSAGE, $parameters), $code, $previous);
    }
}
