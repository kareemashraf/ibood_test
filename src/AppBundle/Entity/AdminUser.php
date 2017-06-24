<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class AdminUser
 *
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class AdminUser extends BaseEntity implements UserInterface
{
    /**
     * @var string
     *
     * @JMS\Expose
     * @JMS\Groups({"details"})
     *
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @var string
     *
     *
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return [
            'ROLE_ADMIN',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return AdminUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSalt()
    {
        return;
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return AdminUser
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
        return;
    }
}
