<?php

namespace Awaresoft\RedirectBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ErrorRepository
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class ErrorRepository extends EntityRepository
{
    /**
     * Find correct Error object by request url.
     *
     * @param $url
     * @param null $locale
     *
     * @return mixed
     */
    public function findByRequestUrl($url, $locale = null)
    {
        $qb = $this->createQueryBuilder('u')
            ->where('u.url = :url')
            ->andWhere('u.validFrom < :dateNow')
            ->andWhere('u.validTo IS NULL OR u.validTo >= :dateNow')
            ->setParameter('url', $url)
            ->setParameter('dateNow', new \DateTime())
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults(1);

        if ($locale) {
            $qb
                ->andWhere('u.locale = :locale')
                ->setParameter('locale', $locale);
        }

        return $qb->getQuery()->getOneOrNullResult();
    }
}