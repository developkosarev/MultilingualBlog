<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;

class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';
    public const MANAGER_USER_REFERENCE = 'manager-user';
    public const USER_REFERENCE = 'user';

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    # region Users

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUsers() as [$email, $password, $roles, $reference]) {

            $user = new User();
            $user->setEmail($email);
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $user->setRoles($roles);

            $manager->persist($user);
            $manager->flush();

            $this->addReference($reference, $user);
        }

        $manager->flush();
    }

    private function getUsers(): array
    {
        return [
            ['admin@example.com', 'admin@2020', ['ROLE_ADMIN', 'ROLE_MANAGER'], self::ADMIN_USER_REFERENCE],
            ['manager@example.com', 'manager@2020', ['ROLE_MANAGER'], self::MANAGER_USER_REFERENCE],
            ['user@example.com', 'user@2020', ['ROLE_USER'], self::USER_REFERENCE],
        ];
    }

    # endregion
}
