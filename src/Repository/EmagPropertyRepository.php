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

    public function getPropertiesForCategoryQb(EmagCategory $category)
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.category = :category')
            ->setParameter('category', $category)
            ->orderBy('p.isRequired', 'DESC')
        ;
    }

    public function getPropertiesForCategory(EmagCategory $category)
    {
        return $this
            ->getPropertiesForCategoryQb($category)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getPropertyChoicesForCategory(EmagCategory $category)
    {
        $props = $this
            ->getPropertiesForCategory($category)
        ;

        $results = [];
        foreach ($props as $prop) {
            $results[$prop->getId()] = $prop;
        }

        return $results;
    }
}
