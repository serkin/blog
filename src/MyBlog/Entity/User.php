<?php

namespace MyBlog\Entity;

/**
 * Class User.
 */
class User extends \Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets primary key.
     *
     * @return string
     */
    public function getPrimaryKey()
    {
        return 'id_user';
    }

    /**
     * @param array $row
     */
    public function mapObject(array $row)
    {
        $entry = new self();

        $entry
            ->setLogin($row['login'])
            ->setId($row['id_user'])
            ->setPassword($row['password']);

        return $entry;
    }

    /**
     * Gets table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return 'user';
    }

    /**
     * @return bool
     */
    public function save()
    {
        return true;
    }
}
