<?php
/**
*Session Class
**/
// lưu hành động khi load lai trang 
class Session{
   // khoi tao file session
 public static function init(){
  if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
            session_start();
        }
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
 }
// setter
 public static function set($key, $val){
    $_SESSION[$key] = $val;
 }
// getter
 public static function get($key){
    if (isset($_SESSION[$key])) {
     return $_SESSION[$key];
    } else {
     return false;
    }
 }
// ham này có chức năng kiểm tra đăng nhập
// nếu chưa đăng nhập thì k cho vào index.php
 public static function checkSession(){
    self::init();
    if (self::get("adminlogin")== false) {
     self::destroy();
     header("Location:login.php");
    }
 }
//hàm check login
 public static function checkLogin(){
    self::init();
    if (self::get("adminlogin")== true) {
     header("Location:index.php");
    }
 }
//hàm đăng xuất
 public static function destroy(){
  session_destroy();
  header("Location:login.php");
 }
}
?>
