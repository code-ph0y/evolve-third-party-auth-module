<?php
namespace ThirdPartyAuthModule\Storage;

use ThirdPartyAuthModule\Storage\Base as BaseStorage;
use ThirdPartyAuthModule\Entity\User as UserEntity;

class User extends BaseStorage
{
    protected $meta_data = array(
        'conn'      => 'main',
        'table'     => 'user_third_party',
        'primary'   => 'id',
        'fetchMode' => \PDO::FETCH_ASSOC
    );

    /**
     * Get a blank user enitity
     *
     * @return mixed
     */
    public function getBlankEntity()
    {
        return new UserEntity();
    }

    /**
     * Make an entity
     *
     * @param  $user_data
     * @return mixed
     */
    public function makeEntity($user_data)
    {
        return new UserEntity($user_data);
    }

    /**
     * Get a user entity by its ID
     *
     * @param $user_id
     * @return mixed
     * @throws \Exception
     */
    public function getByID($user_id)
    {
        $row = $this->ds->createQueryBuilder()
            ->select('u.*, ul.title AS ul_title, ul.id AS ul_id')
            ->from($this->meta_data['table'], 'u')
            ->leftJoin('u', 'user_level', 'ul', 'u.user_level_id = ul.id')
            ->andWhere('u.id = :user_id')->setParameter(':user_id', $user_id)
            ->execute()
            ->fetch($this->meta_data['fetchMode']);

        if ($row === false) {
            throw new \Exception('Unable to obtain user row for id: ' . $user_id);
        }

        return new UserEntity($row);
    }

    /**
     * Find a user record by the email
     *
     * @param  string $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return $this->createQueryBuilder()
            ->select('u.*')
            ->from($this->meta_data['table'], 'u')
            ->andWhere('u.email = :email')->setParameter(':email', $email)
            ->execute()
            ->fetch($this->meta_data['fetchMode']);
    }

    public function getAll()
    {
        $rows = $this->ds->createQueryBuilder()
            ->select("u.*, ul.title AS level_title, IF(uat.used = '0', 0, 1) AS activated")
            ->from($this->meta_data['table'], 'u')
            ->leftJoin('u', 'user_level', 'ul', 'u.user_level_id = ul.id')
            ->leftJoin('u', 'user_activation_token', 'uat', 'uat.user_id = u.id')
            ->execute()
            ->fetchAll($this->meta_data['fetchMode']);

        $entities = $this->rowsToEntities($rows);

        return $entities;
    }

    /**
     * Get a user entity by the email address
     *
     * @param  string $email
     * @return UserEntity
     * @throws \Exception
     */
    public function getByEmail($email)
    {
        $row = $this->findByEmail($email);

        if ($row === false) {
            throw new \Exception('Unable to find user record by email: ' . $email);
        }

        return new UserEntity($row);
    }

    /**
     * Get a user entity by username
     *
     * @param  string $username
     * @return UserEntity
     * @throws \Exception
     */
    public function getByUsername($username)
    {
        $row = $this->createQueryBuilder()
            ->select('u.*')
            ->from($this->meta_data['table'], 'u')
            ->andWhere('u.username = :username')
            ->setParameter(':username', $username)
            ->execute()
            ->fetch($this->meta_data['fetchMode']);

        if ($row === false) {
            throw new \Exception('Unable to find user record by username: ' . $username);
        }

        return new UserEntity($row);
    }

    /**
     * Check if a user record exists by email address
     *
     * @param $email
     * @return bool
     */
    public function existsByEmail($email)
    {
        $row = $this->ds->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->meta_data['table'], 'u')
            ->andWhere('u.email = :email')
            ->setParameter(':email', $email)
            ->execute()
            ->fetch($this->meta_data['fetchMode']);

        return $row['total'] > 0;
    }

    /**
     * Check if a user record exists by username
     *
     * @param $email
     * @return bool
     */
    public function existsByUsername($username)
    {
        $row = $this->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->meta_data['table'], 'u')
            ->andWhere('u.username = :username')
            ->setParameter(':username', $username)
            ->execute()
            ->fetch($this->meta_data['fetchMode']);

        return $row['total'] > 0;
    }

    /**
     * Check if a user record exists by User ID
     *
     * @param integer $id
     * @return bool
     */
    public function existsByID($id)
    {
        $row = $this->createQueryBuilder()
            ->select('count(id) as total')
            ->from($this->meta_data['table'], 'u')
            ->andWhere('u.id = :id')
            ->setParameter(':id', $id)
            ->execute()
            ->fetch($this->meta_data['fetchMode']);

        return $row['total'] > 0;
    }

    /**
     * Delete a user by their email address
     *
     * @param  string $email
     * @return mixed
     */
    public function deleteByEmail($email)
    {
        return $this->delete(array('email' => $email));
    }

    /**
     * Delete a user by their ID
     *
     * @param  integer $user_id
     * @return mixed
     */
    public function deleteByID($user_id)
    {
        return $this->delete(array($this->meta_data['primary'] => $user_id));
    }

    /**
     * Create a user record
     *
     * @param  array $user_data
     * @return integer
     */
    public function create(array $user_data)
    {
        $this->ds->insert($this->meta_data['table'], $user_data);
        return $this->ds->lastInsertId();
    }

    /**
     * Update a user record
     *
     * @param  integer $id
     * @param  array $user_data
     * @return integer
     */
    public function update($id, array $user_data)
    {
        return $this->ds->update($this->meta_data['table'], $user_data, array($this->meta_data['primary'] => $id));
    }

    /**
     * Block a user using their user id
     *
     * @param  integer $user_id
     * @param  integer $block_value
     * @return integer
     */
    public function blockUser(int $user_id, int $block_value)
    {
        $block_value = ($block_value < 0 || $block_value > 1) ? 0 : $block_value;
        return $this->ds->update(
            $this->meta_data['table'],
            array('blocked' => $block_value),
            array($this->meta_data['primary'] => $user_id)
        );
    }

    public function rowsToEntities($rows)
    {
        $ent = array();
        foreach ($rows as $r) {
            $ent[] = new UserEntity($r);
        }
        return $ent;
    }
}
