<?php

namespace MyBlog\Entity;

/**
 * Class Post.
 */
class Post extends \Entity
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $date;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     *
     * @return Post
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

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
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     *
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Gets post's user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->getOctrine()->getRepository('\MyBlog\Entity\User')->findById($this->getUserId());
    }

    /**
     * Gets comments for current post.
     *
     * @return array|Comment[]
     */
    public function getComments()
    {
        return $this->getOctrine()->getRepository('\MyBlog\Entity\Comment')
            ->findCommentsByPostId($this->getId());
    }

    /**
     * Gets primary key.
     *
     * @return string
     */
    public function getPrimaryKey()
    {
        return 'id_post';
    }

    /**
     * Gets table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return 'post';
    }

    /**
     * Entity mapping.
     *
     * @param array $row
     *
     * @return Post
     */
    public function mapObject(array $row)
    {

        $entry = new self();

        $entry
            ->setId($row['id_post'])
            ->setTitle($row['title'])
            ->setText($row['text'])
            ->setDate($row['date'])
            ->setUserId($row['id_user']);

        return $entry;
    }

    /**
     * Saves entity.
     *
     * @return bool
     */
    public function save()
    {
        if (null !== $this->getId()) {
            return false;
        }

        $data = [
            'title' => $this->getTitle(),
            'text' => $this->getText(),
            'id_user' => $this->getUserId(),

        ];

        /** @var \PDO $dbh **/
        $dbh = $this->getOctrine()->getPDO();

        $sql = "INSERT INTO {$this->getTableName()} (`title`,`text`,`id_user`) VALUES (?, ?, ?);";

        $sth = $dbh->prepare($sql);
        $sth->bindParam(1, $data['title'], \PDO::PARAM_STR);
        $sth->bindParam(2, $data['text'], \PDO::PARAM_STR);
        $sth->bindParam(3, $data['id_user'], \PDO::PARAM_INT);

        if ($sth->execute()) {
            $this->setId($dbh->lastInsertId());

            return true;
        }

        return false;
    }
}
