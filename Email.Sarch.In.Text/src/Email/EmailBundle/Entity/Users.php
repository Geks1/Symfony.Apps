<?php

namespace Email\EmailBundle\Entity;

/**
 * Users
 */
class Users
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return Users
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

