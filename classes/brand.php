
<?php
// đường dẫn thật
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class brand 
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
        public function insert_brand($brandName){
            // kiem tra co hop le
            $brandName = $this->fm->validation($brandName); 

            // 1 bien ket noi 1 bien du lieu
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                $alert = "<span class='error'>Tên Danh Mục Trống</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
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
        public function show_brand(){
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            return $result;
        }
        // update
        public function update_brand($brandName, $id){

            $brandName = $this->fm->validation($brandName); 
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($brandName)){
                $alert = "<span class='error'>Tên thương hiệu Trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
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
        public function del_brand($id){
            $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
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
        // get brand by id
        public function getbrandbyId($id){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        // end
        public function get_product_by_brand($id){
            $query = "SELECT * FROM tbl_product WHERE brandId = '$id' LiMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_product_by_brand_list($id){
            $query = "SELECT * FROM tbl_product WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_name_by_brand($id){
            $query = "SELECT tbl_product.*, tbl_brand.brandName, tbl_brand.brandId FROM tbl_product, tbl_brand WHERE tbl_product.brandId = tbl_brand.brandId AND tbl_product.brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

    }
    


?>