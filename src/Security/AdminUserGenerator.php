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

/**
 * Class AdminUserGenerator
 *
 * @author Benjamin Georgeault
 */
class AdminUserGenerator
{
    /**
     * @param string $email
     * @param string $plainPassword
     * @return AdminUser
     */
    public function createAdmin(string $email, string $plainPassword): AdminUser
    {
        $adminUser = new AdminUser();
        $adminUser->setEmail($email);
        $adminUser->setPassword($plainPassword);

        return $adminUser;
    }
}
