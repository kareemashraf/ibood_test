<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Project;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

/**
 * Class LoadProjectData
 *
 * @package AppBundle\DataFixtures\ORM
 */
class LoadProjectData extends ContainerAwareFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new Project();
        $user->setProject('iBood test');
        $user->setDetails('This is the Test Project for iBOOD ');
        $user->setEnabled(true);

        $manager->persist($user);
        $manager->flush();
    }


}