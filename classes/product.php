
<?php
// đường dẫn thật
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class product 
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
        // $data tương ứng $_POST && $files tương ứng $_FILES
        public function insert_product($data,$files){
            // 1 bien ket noi 1 bien du lieu
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $product_type = mysqli_real_escape_string($this->db->link, $data['product_type']);


            // kiểm tra hình ảnh và láy hình ảnh cho vào folder upload
            $permited = array('jpg','jpeg','png','gif');
            // láy tên ảnh
            $file_name =$_FILES['product_image']['name'];
            // láy size ảnh
            $file_size =$_FILES['product_image']['size'];
            // file tạm thời để upload hình ảnh
            $file_temp =$_FILES['product_image']['tmp_name'];

            $div = explode('.',$file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            // unique_image la hinh anh
            $uploaded_image = "uploads/".$unique_image;

            if($productName == "" || $category == "" || $brand == "" || $product_desc == "" || $price == "" || $product_type == "" || $file_name == ""){
                $alert = "<span class='error'>các trường không được trống</span>";
                return $alert;
            }else{
                // move_uploaded_file láy hình ảnh lưu vào folder uploads lưu vào file tạm thời là $file_temp(láy tên) upload hình ảnh vào folder uploads
                move_uploaded_file($file_temp,$uploaded_image);
                // trái trường, so sánh phải csdl 
                $query = "INSERT INTO tbl_product(productName,catId,brandId,product_desc,price,product_type,product_image) VALUES('$productName','$category','$brand','$product_desc','$price','$product_type','$unique_image')";
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
        // hiển thị Sản phẩm
        public function show_product(){

            $query = 
            "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            -- inner join: giao nhau
            FROM tbl_product INNER JOIN tbl_category ON tbl_category.catId = tbl_product.catId

            INNER JOIN tbl_brand ON tbl_brand.brandId = tbl_product.brandId

            ORDER BY tbl_product.productId DESC";

            $result = $this->db->select($query);
            return $result;
        }
        // update
        public function update_product($data, $files, $id){

            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $product_type = mysqli_real_escape_string($this->db->link, $data['product_type']);

            // kiểm tra hình ảnh và láy hình ảnh cho vào folder upload
            $permited = array('jpg','jpeg','png','gif');
            $file_name =$_FILES['product_image']['name'];
            $file_size =$_FILES['product_image']['size'];
            $file_temp =$_FILES['product_image']['tmp_name'];

            // hàm này dùng phân tách sau dấu "." vd( 123 "." jpg)
            $div = explode('.',$file_name);
            // lấy sau dấu chấm của $div mục đích để lưu kiểu của ảnh
            $file_ext = strtolower(end($div));
            // hàm này tạo tên mới(ngẫu nghiên từ 0-10, mã hóa md5) rồi thêm $file_ext(kiểu ảnh) vào sau
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            
            $uploaded_image = "uploads/".$unique_image;

            if($productName == "" || $category == "" || $brand == "" || $product_desc == "" || $price == "" || $product_type == ""){
                $alert = "<span class='error'>các trường không được trống</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
                    // nếu người dùng chọn ảnh
                    if($file_size>1048678){
                    $alert = "<span class='error'>Dung lượng ảnh phải dưới 1mb</span>";
                    return $alert;
                    }
                    elseif(in_array($file_ext, $permited) === false){
                    // upload phải đúng định dạng ảnh $permited
                    $alert = "<span class='error'>Chỉ có thể upload:-".implode(',',$permited)."</span>";
                    return $alert;
                    }
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    brandId = '$brand' ,
                    catId = '$category' ,
                    product_type = '$product_type' ,
                    price = '$price' ,
                    product_image = '$unique_image' ,
                    product_desc = '$product_desc' 
                    WHERE productId = '$id'";
                    $result = $this->db->update($query);
                    if($result == true ){
                        $alert = "<span class='success'>Update Thành Công</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='error'>Update Thất Bại</span>";
                        return $alert;
                    }
                }else{
                    // nếu người dùng không chọn ảnh
                    $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    brandId = '$brand' ,
                    catId = '$category' ,
                    product_type = '$product_type' ,
                    price = '$price' ,
                    product_desc = '$product_desc' 
                    WHERE productId = '$id'";
                
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
        }
        public function del_product($id){
            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
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
        public function getproductbyId($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        /**
         @ kết thúc admin
         */
        // lấy sản phẩn có type=1(hiện)
        public function getproduct_feathered(){
            $query = "SELECT * FROM tbl_product WHERE product_type = '1'Limit 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function getproduct_new(){
            $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_details($id){
            $query = 
            "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            -- inner join: giao nhau
            FROM tbl_product INNER JOIN tbl_category ON tbl_category.catId = tbl_product.catId

            INNER JOIN tbl_brand ON tbl_brand.brandId = tbl_product.brandId

            WHERE tbl_product.productId = '$id'";

            $result = $this->db->select($query);
            return $result;
        }
        public function prd_cat(){
            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_category.catId FROM tbl_product, tbl_category WHERE tbl_product.catId = tbl_category.catId AND tbl_product.productId %'2' = '0'  ORDER BY tbl_product.productId DESC Limit 4";
            $result = $this->db->select($query);
            return $result;
        }
        // sản phẩm mới
        public function prd_brand_show(){
            $query = "SELECT tbl_product.*, tbl_brand.brandName, tbl_brand.brandId FROM tbl_product, tbl_brand WHERE tbl_product.brandId = tbl_brand.brandId ORDER BY tbl_product.productId DESC Limit 4 ";
            $result = $this->db->select($query);
            return $result;
        }
        // sản phẩm nổi bật có type = 1
        public function prd_brand_hide(){
            $query = "SELECT tbl_product.*, tbl_brand.brandName, tbl_brand.brandId FROM tbl_product, tbl_brand WHERE tbl_product.brandId = tbl_brand.brandId AND tbl_product.product_type = '1' ORDER BY tbl_product.productId DESC Limit 4 ";
            $result = $this->db->select($query);
            return $result;
        }
        public function prd_brand_cat(){
            $query = "SELECT tbl_product.*, tbl_brand.brandName, tbl_brand.brandId, tbl_category.catName, tbl_category.catId FROM tbl_product, tbl_brand, tbl_category WHERE tbl_product.brandId = tbl_brand.brandId AND tbl_product.catId = tbl_category.catId AND tbl_product.productId %'2' = '0' ORDER BY tbl_product.productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function prd_brand_cat_sale(){
            $query = "SELECT tbl_product.*, tbl_brand.brandName, tbl_brand.brandId, tbl_category.catName, tbl_category.catId FROM tbl_product, tbl_brand, tbl_category WHERE tbl_product.brandId = tbl_brand.brandId AND tbl_product.catId = tbl_category.catId AND tbl_category.catId = '28' ORDER BY tbl_product.productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
    }
    
?>