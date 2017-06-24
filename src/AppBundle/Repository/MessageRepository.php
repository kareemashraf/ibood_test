<?php
/**
 * Created by PhpStorm.
 * User: pvankrugten
 * Date: 07/04/2017
 * Time: 08:59
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository
{

    public function findAllStorylineIds()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT storyline_id FROM AppBundle:Message GROUP BY storyline_id'
            )
            ->getResult();
    }

}