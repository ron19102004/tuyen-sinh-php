<?php
/**
 * @template Entity
 */
interface Repository{
    /**
     * @return array<Entity>
     */
    public function find();
    /**
     * @param int $id
     * @return Entity|null
     */
    public function findById($id);
    /**
     * @param Entity $entity
     * @return bool|string
     */
    public function save($entity);
    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);
}