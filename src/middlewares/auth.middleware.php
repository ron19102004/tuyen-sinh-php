<?php
Import::utils(["session.util.php"]);
function isActiveLink($page_path)
{
  return $_SERVER['REQUEST_URI'] == '/src/views/pages/' . $page_path;
}
class AuthMiddleware
{
  public static function getRoleCurrent()
  {
    $id = Session::get("user_id");
    if (!$id) {
      return null;
    }
    $conn = DB::connect();
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id AND deleted = 0");
    $stmt->bindParam(':id', $id);
    $id = intval($id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;
    if ($result) {
      return UserEntity::fromArray($result)->role;
    }
    return null;
  }
  /**
   * @return bool
   */
  public static function isRole($role)
  {
    if (AuthMiddleware::isAuth())
      return false;
    $roleCurrent = AuthMiddleware::getRoleCurrent();
    if (!$roleCurrent)
      return false;
    return $roleCurrent == $role;
  }
  /**
   * @return bool
   */
  public static function isAuth()
  {
    return Session::get("is_authenticated") ?? false;
  }
  /**
   * 
   * @param array<string> $role
   * @param callable $success
   * @param callable $error
   * @return void
   */
  public static function hasRoles($roles, $success, $error)
  {
    if (Session::get("is_authenticated") == false) {
      $error("Yêu cầu đăng nhập");
      return;
    }
    $roleCurrent = AuthMiddleware::getRoleCurrent();
    if (in_array($roleCurrent, $roles) == false) {
      $error("Không có quyền truy cập!");
      return;
    }
    $success();
  }
  /**
   * @param callable $success
   * @param callable $error
   * @return void
   */
  public static function isAuthenticated($success, $error)
  {
    if (Session::get("is_authenticated") == false) {
      $error();
      return;
    }
    $success();
  }
}
