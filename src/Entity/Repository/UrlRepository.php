<?php

namespace Awaresoft\RedirectBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use DoctrineExtensions\Query\SortableNullsWalker;

/**
 * Class UrlRepository
 *
 * @author Bartosz Malec <b.malec@awaresoft.pl>
 */
class UrlRepository extends EntityRepository
{
    /**
     * Find correct Url object by request url.
     *
     * @param $url
     * @param null $locale
     *
     * @return mixed
     */
    public function findByRequestUrl($url, $locale = null)
    {
        $qb = $this->createQueryBuilder('u')
            ->where('u.urlFrom = :urlFrom')
            ->andWhere('u.validFrom < :dateNow')
            ->andWhere('u.validTo IS NULL OR u.validTo >= :dateNow')
            ->setParameter('urlFrom', $url)
            ->setParameter('dateNow', new \DateTime())
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults(1);

        if ($locale) {
            $qb
                ->andWhere('u.locale = :locale')
                ->setParameter('locale', $locale);
        }

        return $qb->getQuery()
            ->getOneOrNullResult();
    }
}
