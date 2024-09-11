<?php
Import::utils(["session.util.php"]);
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
   * @param callable $callback
   * @return void
   */
  public static function hasRoles($roles, $callback)
  {
    if (Session::get("is_authenticated") == false) {
      header("Location: /src/views/pages/auth/login.php");
      return;
    }
    if (in_array(Session::get("user_role"), $roles) == false) {
      header("Location: /src/views/pages/user/home/page.php");
      return;
    }
    $callback();
  }
  /**
   * @param callable $callback
   * @return void
   */
  public static function isAuthenticated($callback)
  {
    if (Session::get("is_authenticated") == false) {
      header("Location: /src/views/pages/auth/login.php");
      return;
    }
    $callback();
  }
}
