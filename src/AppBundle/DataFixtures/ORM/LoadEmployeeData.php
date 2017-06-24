<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Employee;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

/**
 * Class LoadEmployeeData
 *
 * @package AppBundle\DataFixtures\ORM
 */
class LoadEmployeeData extends ContainerAwareFixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new Employee();
        $user->setEmployee('Kareem');
        $user->setAddress('Warande 201 Zeist 3705zr UTRECHT');
        $user->setPhone('0682619250');
        $user->setPosition('Web Developer');
        $user->setNationality('egyptian');
        $user->setImage('1234567890.jpeg');
        $user->setEnabled(true);

        $user2 = new Employee();
        $user2->setEmployee('Kasper');
        $user2->setAddress('Amsterdam Somewhere');
        $user2->setPhone('0126789');
        $user2->setPosition('Manager');
        $user2->setNationality('dutch');
        $user2->setImage('1234567890.jpeg');
        $user2->setEnabled(true);

        $manager->persist($user);
        $manager->persist($user2);
        $manager->flush();
    }


}