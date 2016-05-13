<?php

namespace Xcx\IstxtBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * IsdocRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IsdocRepository extends EntityRepository
{
    
    public function getActiveIsdoc($category_id = null)
    {
        $qb = $this->createQueryBuilder('i')
        ->where('i.expires_at > :date')
        ->setParameter('date', date('Y-m-d H:i:s', time()))
        ->orderBy('i.expires_at', 'DESC');
    
        if ($category_id) {
            $qb->andWhere('i.category = :category_id')
            ->setParameter('category_id', $category_id);
        }
    
        $query = $qb->getQuery();
    
        return $query->getResult();
    }
    
    public function getActiveIstxtk($id)
    {
        $query = $this->createQueryBuilder('i')
        ->where('i.id = :id')
        ->setParameter('id', $id)
        ->andWhere('i.expires_at > :date')
        ->setParameter('date', date('Y-m-d H:i:s', time()))
        ->setMaxResults(1)
        ->getQuery();
    
        try {
            $doc = $query->getSingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $doc = null;
        }
    
        return $doc;
    }
    
    
}
