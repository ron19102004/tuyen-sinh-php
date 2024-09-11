<?php
enum UserRole: string {
  case User = 'Người dùng';
  case Cashier = 'Thu ngân';
  case Admin = 'Quản trị hệ thống';
  case AdmissionCommittee = 'Ban tuyển sinh';
  case BoardOfDirectors = 'Ban giám hiệu';
}
class UserEntity
{
  public $id, $username, $email, $password, $fullName, $phone,$role;
  public function __construct($id, $username, $email, $password, $fullName, $phone, $role)
  {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->fullName = $fullName;
    $this->phone = $phone;
    $this->role = $role;
  }
  /**
   * @param mixed $data
   * @return UserEntity
   */
  public static function fromArray($data)
  {
    return new UserEntity(
      $data['id'],
      $data['username'],
      $data['email'],
      $data['password'],
      $data['fullName'],
      $data['phone'],
      $data['role']
    );
  }
  public function toArray()
  {
    return [
      'id' => $this->id,
      'username' => $this->username,
      'email' => $this->email,
      "fullName" => $this->fullName,
      'phone' => $this->phone,
      'role' => $this->toVNStringRole($this->role),
    ];
  }
  private function toVNStringRole($role){
    switch ($role) {
      case UserRole::User->name:
        return UserRole::User->value;
      case UserRole::Cashier->name:
        return UserRole::Cashier->value;
      case UserRole::Admin->name:
        return UserRole::Admin->value;
      case UserRole::AdmissionCommittee->name:
        return UserRole::AdmissionCommittee->value;
      case UserRole::BoardOfDirectors->name:
        return UserRole::BoardOfDirectors->value;
    }
  }
}
