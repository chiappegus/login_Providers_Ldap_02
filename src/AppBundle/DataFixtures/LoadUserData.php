<?php

namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadUserData extends Fixture implements ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {

        $user = new \AppBundle\Entity\User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $encoder  = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, '0000');
        $user->setPassword($password);

        $manager->persist($user);

       // $manager->flush();


        $user = new \AppBundle\Entity\User();
        $user->setUsername('gustavo');
        $user->setEmail('gustavo@gustavo.com');
        $encoder  = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, '0');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();

    }

    public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container = null)
    {
        $this->container = $container;
    }

}
