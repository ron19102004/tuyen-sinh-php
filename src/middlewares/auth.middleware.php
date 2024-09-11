<?php
Import::utils(["session.util.php"]);
class AuthMiddleware {
  /**
   * 
   * @param array<string> $role
   * @param callable $callback
   * @return void
   */
  public static function hasRoles($roles, $callback){
    if(Session::get("is_authenticated") == false){
        header("Location: /src/views/pages/auth/login.php");
        return;
    }
    if(in_array(Session::get("role"),$roles) == false){
        header("Location: /src/views/pages/auth/login.php");
        return;
    }
    $callback();
  }
  /**
   * @param callable $callback
   * @return void
   */
  public static function isAuthenticated($callback){
    if(Session::get("is_authenticated") == false){
        header("Location: /src/views/pages/auth/login.php");
        return;
    }
    $callback();
  }
}