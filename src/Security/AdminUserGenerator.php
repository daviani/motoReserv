<?php

/*
 * This file is part of the adrec-pilotage package.
 *
 * (c) Benjamin Georgeault <https://www.drosalys-web.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Security;

use App\Entity\AdminUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AdminUserGenerator
 *
 * @author Benjamin Georgeault
 */
class AdminUserGenerator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * AdminUserGenerator constructor.
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    /**
     * @param string $email
     * @param string $plainPassword
     * @return AdminUser
     */
    public function createAdmin(string $email, string $plainPassword): AdminUser
    {
        $adminUser = new AdminUser();
        $adminUser->setEmail($email);

        $password = $this->encoder->encodePassword($adminUser, $plainPassword);
        $adminUser->setPassword($password);

        $this->em->persist($adminUser);
        $this->em->flush();

        return $adminUser;
    }
}
