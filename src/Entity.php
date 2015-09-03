<?php

/**
 * Class Entity.
 */
abstract class Entity
{
    /**
     * @var Octrine
     */
    protected $octrine;

    /**
     * @return Octrine
     */
    public function getOctrine()
    {
        return $this->octrine;
    }

    /**
     * @param Octrine $octrine
     */
    public function setOctrine($octrine)
    {
        $this->octrine = $octrine;
    }

    /**
     * Gets entity's table name.
     *
     * @return string
     */
    abstract public function getTableName();

    /**
     * Gets primary key.
     *
     * @return string
     */
    abstract public function getPrimaryKey();

    /**
     * Object mapping.
     *
     * @param array $row
     *
     * @return Entity
     */
    abstract public function mapObject(array $row);

    /**
     * Saves entity.
     *
     * @return bool
     */
    abstract public function save();
}
