<?php

namespace Awaresoft\RedirectBundle\Provider;

use Awaresoft\RedirectBundle\Entity\Error;
use Awaresoft\RedirectBundle\Exception\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Error Provider
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class ErrorProvider extends AbstractProvider
{
    /**
     * @inheritdoc
     */
    public function createError($url, $code, $message = null, \DateTime $validTo = null, \DateTime $validFrom = null)
    {
        /**
         * @var Error $error
         */
        $error = new $this->class;
        $error->setUrl($url);
        $error->setCode($code);
        $error->setMessage($message);
        $error->setValidTo($validTo);

        if (!$validFrom) {
            $error->getValidFrom($validFrom);
        }

        $this->preSave($error);

        $this->save($error);
    }

    /**
     * @inheritdoc
     */
    public function createResponse(Request $request)
    {
        /**
         * @var Error $entity
         */
        $locale = $this->siteSelector->retrieve()->getLocale();
        $entity = $this->em->getRepository($this->class)->findByRequestUrl($request->getPathInfo(), $locale);

        if (!$entity) {
            throw new EntityNotFoundException();
        }

        $this->validateCode($entity->getCode());

        throw new \Exception($entity->getMessage(), $entity->getCode());
    }
}