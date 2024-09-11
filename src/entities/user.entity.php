<?php
class UserEntity {
  public $id,$username,$email,$password;
  public function __construct($id, $username, $email, $password) {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
  }
  /**
   * @param mixed $data
   * @return UserEntity
   */
  public static function fromArray($data){
    return new UserEntity($data['id'], $data['username'], $data['email'], $data['password']);
  }
  public function toArray() {
    return [
      'id' => $this->id,
      'username' => $this->username,
      'email' => $this->email,
      'password' => $this->password
    ];
  }
}