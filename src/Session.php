<?php

/**
 * Class Session.
 */
class Session
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $userLogin;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Sets user id.
     *
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        $_SESSION['userId'] = $userId;
    }

    /**
     * Gets user login.
     *
     * @return string
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

    /**
     * @param string $userLogin
     */
    public function setUserLogin($userLogin)
    {
        $this->userLogin = $userLogin;
        $_SESSION['userLogin'] = $userLogin;
    }

    /**
     * Checks if user authorized.
     *
     * @return bool
     */
    public function isClientAuthorized()
    {
        return isset($this->userId);
    }

    /**
     * Clears session.
     */
    public function destroy()
    {
        $this->setUserLogin(null);
        $this->setUserId(null);
    }
}
