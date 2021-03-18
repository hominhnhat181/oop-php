
<?php
// đường dẫn thật
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class category 
    {

        private $db;
        private $fm;

        public function __construct()
        {
            // goi class Database tu file database.php
            $this->db = new Database();
            $this->fm = new Format();

        }
        // ham thêm danh mục
        public function insert_category($catName){
            // kiem tra co hop le
            $catName = $this->fm->validation($catName); 
            // connect database
            // 1 bien ket noi 1 bien du lieu
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)){
                $alert = "<span class='error'>Tên Danh Mục Trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                // insert
                $result = $this->db->insert($query);
                if($result == true ){
                    $alert = "<span class='success'>Thêm Thành Công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm Thất Bại</span>";
                    return $alert;
                }
            }
        }
        // hiển thị danh mục
        public function show_category(){
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            return $result;
        }
        // update
        public function update_category($catName, $id){

            $catName = $this->fm->validation($catName); 
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($catName)){
                $alert = "<span class='error'>Tên Danh Mục Trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
                // insert
                $result = $this->db->update($query);
                if($result == true ){
                    $alert = "<span class='success'>Update Thành Công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Update Thất Bại</span>";
                    return $alert;
                }
            }
        }
        public function del_category($id){
            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                if($result == true ){
                    $alert = "<span class='success'>Delete Thành Công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Delete Thất Bại</span>";
                    return $alert;
                }
            }
          
        }
        // get category by id
        public function getcatbyId($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        // end
        public function get_product_by_cat($id){
            $query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY catId desc LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_name_by_cat($id){
            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_category.catId FROM tbl_product, tbl_category WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
    


?>