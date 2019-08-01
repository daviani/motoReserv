<?php

namespace App\Tests\Security;

use App\Entity\AdminUser;
use App\Security\AdminUserGenerator;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserGeneratorTest extends TestCase
{
    public function testCreateAdmin()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->getMockBuilder(EntityManagerInterface::class)
            ->getMock();

        /** @var UserPasswordEncoderInterface|MockObject $encoder */
        $encoder = $this->getMockBuilder(UserPasswordEncoderInterface::class)
            ->getMock();

        $encoder->expects($this->any())
            ->method('encodePassword')
            ->willReturn('pass_hash');

        $generator = new AdminUserGenerator($em, $encoder);

        $adminUser = $generator->createAdmin('foo@bar.fr', '1234');

        $this->assertInstanceOf(AdminUser::class, $adminUser);

        $this->assertSame('foo@bar.fr', $adminUser->getEmail());
        $this->assertSame('pass_hash', $adminUser->getPassword());
    }
}
