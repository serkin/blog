<?php

/**
 * Just basic DBAL extended with mapping.
 */
class Octrine
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var Entity
     */
    protected $entity;

    /**
     * @param PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Instantiates Entity.
     *
     * @param string $repository
     *
     * @return Octrine
     */
    public function getRepository($repository)
    {

        /** var Entity $entity **/
        $entity = new $repository();
        $this->setEntity($entity);

        return $this;
    }

    /**
     * Gets current PDO.
     *
     * @return \PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * Gets all records from table.
     *
     * @return Entity[]|array
     */
    public function findAll()
    {
        $dbh = $this->getPDO();

        $sql = "SELECT * FROM {$this->getEntity()->getTableName()}";
        $sth = $dbh->prepare($sql);
        $sth->execute();

        $entries = [];

        foreach ($sth->fetchAll() as $row) {

            /** @var Entity $entity */
            $entity = $this->getEntity()->mapObject($row);
            $entity->setOctrine($this);

            $entries[] = $entity;
        }

        return $entries;
    }

    /**
     * Seeks for comment associated with given post id.
     *
     * @param int $id Post id
     *
     * @return \MyBlog\Entity\Comment[]|array
     */
    public function findCommentsByPostId($id)
    {
        $dbh = $this->getPDO();

        $sql = "SELECT * FROM {$this->getEntity()->getTableName()} WHERE id_post = ?";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(1, $id, PDO::PARAM_INT);
        $sth->execute();

        $entries = [];

        foreach ($sth->fetchAll() as $row) {

            /** @var Entity $entity */
            $entity = $this->getEntity()->mapObject($row);
            $entity->setOctrine($this);

            $entries[] = $entity;
        }

        return $entries;
    }

    /**
     * Seeks for user with given login.
     *
     * @param string $login
     *
     * @return \MyBlog\Entity\User|null
     */
    public function findByUserLogin($login)
    {
        $dbh = $this->getPDO();

        $sql = "SELECT
                  *
                FROM
                  {$this->getEntity()->getTableName()}
                WHERE
                  `login` = ?";

        $sth = $dbh->prepare($sql);
        $sth->bindParam(1, $login, PDO::PARAM_STR);
        $sth->execute();

        $row = $sth->fetch();

        if ($row) {

            /** @var Entity $entity */
            $entity = $this->getEntity()->mapObject($row);
            $entity->setOctrine($this);

            return $entity;
        }

        return;
    }

    /**
     * Seeks for entity associated with given id.
     *
     * @param int $id
     *
     * @return Entity|null
     */
    public function findById($id)
    {
        $dbh = $this->getPDO();

        $sql = "SELECT
                  *
                FROM
                  {$this->getEntity()->getTableName()}
                WHERE
                  {$this->getEntity()->getPrimaryKey()} = ?";

        $sth = $dbh->prepare($sql);
        $sth->bindParam(1, $id, PDO::PARAM_INT);
        $sth->execute();

        $row = $sth->fetch();

        if ($row) {

            /** @var Entity $entity */
            $entity = $this->getEntity()->mapObject($row);
            $entity->setOctrine($this);

            return $entity;
        }

        return;
    }

    /**
     * Gets current working entity.
     *
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Sets working entity.
     *
     * @param mixed $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }
}
