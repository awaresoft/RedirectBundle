<?php

namespace Awaresoft\RedirectBundle\Provider;

use Awaresoft\RedirectBundle\Entity\Domain;
use Awaresoft\RedirectBundle\Exception\EntityNotFoundException;
use Awaresoft\RedirectBundle\Exception\EntityParameterIsMissingException;
use Awaresoft\RedirectBundle\Exception\ResponseException;
use Awaresoft\RedirectBundle\Exception\UrlGenerationException;
use Awaresoft\RedirectBundle\UrlGenerator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Domain Provider
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class DomainProvider extends AbstractProvider
{
    /**
     * @inheritdoc
     */
    public function createDomain($domainFrom, $domainTo, $pathFrom, $pathTo, $code, \DateTime $validTo = null, \DateTime $validFrom = null)
    {
        /**
         * @var Domain $domain
         */
        $domain = new $this->class;
        $domain->setDomainFrom($domainFrom);
        $domain->setDomainTo($domainTo);
        $domain->setPathFrom($pathFrom);
        $domain->setPathTo($pathTo);
        $domain->setCode($code);
        $domain->setValidTo($validTo);

        if (!$validFrom) {
            $domain->getValidFrom($validFrom);
        }

        $this->preSave($domain);

        $this->save($domain);
    }

    /**
     * @inheritdoc
     */
    public function createResponse(Request $request)
    {
        /**
         * @var Domain $entity
         */
        $site = $this->siteSelector->retrieve();
        $locale = null;

        if ($site) {
            $locale = $this->siteSelector->retrieve()->getLocale();
        }

        $entity = $this->em->getRepository($this->class)->findByRequestUrl($request->getRequestUri(), $locale);

        if (!$entity) {
            throw new EntityNotFoundException();
        }

        // find strategy

        if ($entity->getUrlTo()) {
            $url = $this->urlToUrlStrategy($entity);
        } elseif ($entity->getGenerateMethod()) {
            $url = $this->urlToMethodStrategy($entity, $request);
        } else {
            throw new EntityParameterIsMissingException(['getUrlTo(), getGenerateMethod()']);
        }

        $this->validateCode($entity->getCode());
        $url = str_replace('/app_dev.php', '', $url);

        return new RedirectResponse($request->getBaseUrl() . $url, $entity->getCode());
    }

    /**
     * @param Domain $entity
     * @param Request $request
     *
     * @return string
     * @throws UrlGenerationException
     */
    protected function urlToMethodStrategy(Domain $entity, Request $request)
    {
        $class = $entity->getGenerateMethod();
        $object = new $class;

        if (!$object instanceof UrlGeneratorInterface) {
            throw new UrlGenerationException(sprintf('%s class doesn\'t implement UrlGeneratorInterface', $entity->getGenerateMethod()));
        }

        return $object->generate($request, $this->container);
    }

    /**
     * @param Domain $entity
     *
     * @return string
     */
    protected function urlToUrlStrategy(Domain $entity)
    {
        return $entity->getUrlTo();
    }
}
