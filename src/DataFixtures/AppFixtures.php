<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Client;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
     $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        /// create 20 products! Bam!
        $roles[] = "ROLE_USER";
        for ($i = 0; $i < 5; $i++) {
            $user = new Client();
            $password = $this->encoder->encodePassword($user, "12345");
            $user->setFirstName('phat')
                ->setLastName('loussamboulou')
                ->setEmail('louss@gmail.com')
                ->setTelephone('0605928831')
                ->setAddress('05 rue marduc')
                ->setCreatedAt(new \DateTime())
                ->setUpdateAt(new \DateTime())
                ->setPassword($password)
                ->setRoles($roles);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
