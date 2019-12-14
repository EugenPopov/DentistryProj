<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;


    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<3; $i++){
            $user = new User();
            $user->setEmail(sprintf('admin%d@stomasvit.com', $i));
            $user->setRoles(['ROLE_ADMIN']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin'
            ));

            $manager->persist($user);
        }

        $manager->flush();

    }
}
