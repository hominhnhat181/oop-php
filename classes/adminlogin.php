
<?php
$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../lib/session.php');
// goi toi ham checkLogin ben file session.php
Session::checkLogin();
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class adminlogin 
    {

        private $db;
        private $fm;

        public function __construct()
        {
            // goi class Database tu file database.php
            $this->db = new Database();
            $this->fm = new Format();

        }
        // ham kiem tra user and pass
        function login_admin($adminUser,$adminPass){
            // kiem tra co hop le
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            // connect database
            // 1 bien ket noi 1 bien du lieu
            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass)){
                $alert = " Ten va Pass trong";
                return $alert;
            }else{
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
                // ham select nay co tu database.php
                $result = $this->db->select($query);

                // neu dung
                if($result != false){
                    $value = $result->fetch_assoc();
                    // goi ham set tu session.php
                    // $value['goi dung ten csdl']
                    // ben phai la ten do minh tao ra ben trai la ten cot csdl
                    // setter
                    Session::set('adminlogin',true);
                    Session::set('adminId',$value['adminId']);
                    Session::set('adminUser',$value['adminUser']);
                    Session::set('adminName',$value['adminName']);
                    header('Location:index.php');
                }else{
                    $alert = "MK va TK sai";
                    return $alert;
                }
            }
        }
    }


?>