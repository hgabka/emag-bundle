<?php

namespace Hgabka\EmagBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Hgabka\EmagBundle\Entity\EmagCategory;

class EmagPropertyRepository extends EntityRepository
{
    public function findOneByEmagIdAndCategory($emagId, EmagCategory $category)
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.emagId = :emagid')
            ->andWhere('p.category = :category')
            ->setParameters([
                'emagid' => $emagId,
                'category' => $category,
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getPropertiesForCategory(EmagCategory $category)
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.category = :category')
            ->setParameter('category', $category)
            ->orderBy('p.isRequired', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
