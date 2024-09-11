<?php
class UserRepository implements Repository
{
    /**
     * @return array<UserEntity>
     */
    public function find()
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($result as $user) {
            array_push($users, UserEntity::fromArray($user));
        }
        return $users;
    }
    /**
     * @param string $email
     * @return UserEntity|null
     */
    public function findByEmail($email)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return UserEntity::fromArray($result);
        }
        return null;
    }
    /**
     * @param int $id
     * @return UserEntity|null
     */
    public function findById($id)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $id = intval($id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return UserEntity::fromArray($result);
        }
        return null;
    }
    /**
     * @param UserEntity $user
     * @return bool|string
     */
    public function save($user)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare(
            "INSERT INTO users(username, email,password,fullName,phone) VALUES (:username, :email, :password, :fullName, :phone)");
        $stmt->bindParam(':username', $user->username);
        $stmt->bindParam(':email', $user->email);
        $password = password_hash($user->password,PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullName', $user->fullName);
        $stmt->bindParam(':phone', $user->phone);
        $stmt->execute();
        return $conn->lastInsertId();
    }
    public function findByUsername($username){
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return UserEntity::fromArray($result);
        }
        return null;
    }
    public function findByPhone($phone){
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE phone = :phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return UserEntity::fromArray($result);
        }
        return null;
    }
    public function deleteById($id)
    {
        return true;
    }
}
