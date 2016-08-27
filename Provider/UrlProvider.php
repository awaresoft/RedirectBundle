<?php

namespace Awaresoft\RedirectBundle\Provider;

use Awaresoft\RedirectBundle\Entity\Url;
use Awaresoft\RedirectBundle\Exception\EntityNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Url Provider
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class UrlProvider extends AbstractProvider
{
    /**
     * @inheritdoc
     */
    public function createUrl($urlFrom, $urlTo, $code, \DateTime $validTo = null, \DateTime $validFrom = null)
    {
        /**
         * @var Url $url
         */
        $url = new $this->class;
        $url->setUrlFrom($urlFrom);
        $url->setUrlTo($urlTo);
        $url->setCode($code);
        $url->setValidTo($validTo);

        if (!$validFrom) {
            $url->getValidFrom($validFrom);
        }

        $this->preSave($url);

        $this->save($url);
    }

    /**
     * @inheritdoc
     */
    public function createResponse(Request $request)
    {
        /**
         * @var Url $entity
         */
        $locale = $this->siteSelector->retrieve()->getLocale();
        $entity = $this->em->getRepository($this->class)->findByRequestUrl($request->getPathInfo(), $locale);

        if (!$entity) {
            throw new EntityNotFoundException();
        }

        $this->validateCode($entity->getCode());

        return new RedirectResponse($request->getBaseUrl() . $entity->getUrlTo(), $entity->getCode());
    }
}