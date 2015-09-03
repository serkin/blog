<?php

namespace MyBlog\Entity;

/**
 * Class Comment.
 */
class Comment extends \Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int|null
     */
    protected $userId;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var int
     */
    protected $postId;

    /**
     * @var string
     */
    protected $date;

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
     * @return Comment
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     *
     * @return Comment
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return int
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     *
     * @return Comment
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

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
     * @return Comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Gets user from current Comment entity.
     *
     * @return \Entity|null
     */
    public function getUser()
    {
        return $this->getOctrine()->getRepository('\MyBlog\Entity\User')->findById($this->getUserId());
    }

    /**
     * Gets primary key.
     *
     * @return string
     */
    public function getPrimaryKey()
    {
        return 'id_comment';
    }

    /**
     * Gets table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return 'comment';
    }

    /**
     * Entity mapping.
     *
     * @param array $row
     *
     * @return Comment
     */
    public function mapObject(array $row)
    {
        $entry = new self();

        $entry
            ->setId($row['id_comment'])
            ->setPostId($row['id_post'])
            ->setComment($row['comment'])
            ->setUserId($row['id_user'])
            ->setDate($row['date']);

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
            'comment' => $this->getComment(),
            'id_post' => $this->getPostId(),
            'id_user' => $this->getUserId(),

        ];

        /** @var \PDO $dbh **/
        $dbh = $this->getOctrine()->getPDO();

        $sql = "INSERT INTO {$this->getTableName()} (`comment`,`id_post`,`id_user`) VALUES (?, ?, ?);";

        $sth = $dbh->prepare($sql);
        $sth->bindParam(1, $data['comment'], \PDO::PARAM_STR);
        $sth->bindParam(2, $data['id_post'], \PDO::PARAM_INT);
        $sth->bindParam(3, $data['id_user'], \PDO::PARAM_INT);
        $sth->execute();
    }
}
