<?php
Import::utils(["session.util.php"]);
function isActiveLink($page_path)
{
    return $_SERVER['REQUEST_URI'] == '/src/views/pages/' . $page_path;
}
class AuthMiddleware
{
  /**
   * @return bool
   */
  public static function isRole($role)
  {
    if (AuthMiddleware::isAuth())
      return false;
    if (!Session::get("user_role"))
      return false;
    return Session::get("user_role") == $role;
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
    if (in_array(Session::get("user_role"), $roles) == false) {
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
