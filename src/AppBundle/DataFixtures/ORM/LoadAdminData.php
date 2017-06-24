<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\AdminUser;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

/**
 * Class LoadAdminData
 *
 * @package AppBundle\DataFixtures\ORM
 */
class LoadAdminData extends ContainerAwareFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new AdminUser();
        $user->setUsername('admin');
        $user->setPassword($this->container->get('security.password_encoder')->encodePassword($user, '2eZwc<#F&^3MPj~b'));
        $user->setEnabled(true);

        $manager->persist($user);
        $manager->flush();
    }


}