<?php

namespace Xcx\IstxtBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function getWithIsdoc()
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT c FROM XcxIstxtBundle:Category c LEFT JOIN c.isdoc i WHERE i.expires_at > :date'
            )->setParameter('date', date('Y-m-d H:i:s', time()));
    
            return $query->getResult();
    }
    
    
}
