<?php
class UserRepository implements Repository
{
    public function countEach()
    {
        $conn = DB::connect();
        $sql = "SELECT 
                COUNT(CASE WHEN role = 'User' THEN 1 END) as user_count,
                COUNT(CASE WHEN role = 'Cashier' THEN 1 END) as cashier_count,
                COUNT(CASE WHEN role = 'Admin' THEN 1 END) as admin_count,
                COUNT(CASE WHEN role = 'AdmissionCommittee' THEN 1 END) as admission_committee_count,
                COUNT(CASE WHEN role = 'BoardOfDirectors' THEN 1 END) as board_of_directors_count
                FROM users where deleted = 0";
         $stmt = $conn->prepare($sql);
         $stmt->execute();
         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $conn = null;
         return $result;
    }
    /**
     * @param int $id
     * @param string $role
     * @return bool
     */
    public function updateRole($id, $role)
    {
        $conn = DB::connect();
        $sql = "UPDATE users SET role = :role WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        $conn = null;
        return $result;
    }

    /**
     * @return array<UserEntity>
     */
    public function find()
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE deleted = 0");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $users = [];
        foreach ($result as $user) {
            array_push($users, UserEntity::fromArray($user));
        }
        return $users;
    }
    /**
     * @param int $id
     * @param int $get
     * @param int $from
     * @return array<UserEntity>
     */
    public function findIgnoreId($id, $get = 10, $from = 0)
    {
        $conn = DB::connect();
        $sql = "SELECT * FROM users WHERE deleted = 0 AND id != :id ORDER BY id DESC LIMIT :get OFFSET :from";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':get', $get, PDO::PARAM_INT);
        $stmt->bindParam(':from', $from, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
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
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND deleted = 0");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
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
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id AND deleted = 0");
        $stmt->bindParam(':id', $id);
        $id = intval($id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
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
            "INSERT INTO users(username, email,password,fullName,phone) VALUES (:username, :email, :password, :fullName, :phone)"
        );
        $stmt->bindParam(':username', $user->username);
        $stmt->bindParam(':email', $user->email);
        $password = password_hash($user->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fullName', $user->fullName);
        $stmt->bindParam(':phone', $user->phone);
        $stmt->execute();
        $result = $conn->lastInsertId();
        $conn = null;
        return $result > 0;
    }
    public function findByUsername($username)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND deleted = 0");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
            return UserEntity::fromArray($result);
        }
        return null;
    }
    public function findByPhone($phone)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE phone = :phone AND deleted = 0");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;
        if ($result) {
            return UserEntity::fromArray($result);
        }
        return null;
    }
    public function deleteById($id)
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("UPDATE users SET deleted = 1 WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->rowCount() > 0;
        $conn = null;
        return $result;
    }
    public function countUser()
    {
        $conn = DB::connect();
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM users WHERE deleted = 0");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = $result['total'];
        $conn = null;
        return $result;
    }
}
