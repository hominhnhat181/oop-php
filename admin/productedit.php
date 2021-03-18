<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>

<?php

// new class(not file)
 $pd = new product();
// nếu không láy được id của sản phẩm thì về lại danh sách sản phẩm else láy id sản phẩm lưu vào biến $id
if(!isset($_GET['productid']) || $_GET['productid']==null){
    echo "<script>window.location = 'productlist.php'</script>";
}else
    $id = $_GET['productid'];
// khi kich submit
 if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
// thuc hien lenh nay
	 $updateProduct = $pd->update_product($_POST, $_FILES, $id) ;
 }


?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">     
        <?php 
                if(isset($updateProduct)){
                    echo $updateProduct;
                }
        ?>            
        <!-- enctype dùng update and thêm mới something -->
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <?php
               $get_product_by_id= $pd->getproductbyId($id);
                    if($get_product_by_id){
                        while($result_product = $get_product_by_id->fetch_assoc()){

               ?>
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>Lựa chọn danh mục</option>
                            <?php 
                            // kế thừ class category vào biến cat
                            $cat = new category();
                            $catlist = $cat->show_category();
                            if($catlist){
                                while($result = $catlist->fetch_assoc()){
                            ?>
                            <option
                            <?php
                            // nếu catId từ product trùng catId category thì in ra
                            if($result['catId'] == $result_product['catId']){ echo 'selected'; }
                            ?>
                            
                             value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                                       
                            <?php 
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>Lựa chọn thương hiệu</option>
                            <?php
                            $brand = new brand();
                            $brandlist=$brand->show_brand();
                            if($brandlist){
                                while($result = $brandlist->fetch_assoc()){
   
                            ?>
                            <option
                            <?php 
                            if($result['brandId'] == $result_product['brandId']){ echo 'selected'; }
                            ?>
                            
                             value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                            
                            <?php
                                                             
                                }
                            }
                                                        
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Chi tiết</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result_product['price'] ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>

                        <input type="file" name="product_image" /> <br/>
                        <img src="uploads/<?php echo $result_product['product_image'] ?>" width="80px" height="80px">
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="product_type">
                            <option>Chọn chức năng</option>
                            <?php 

                            if($result_product['product_type'] == 1){

                            ?>
                            <option selected value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                            <?php 
                            }else{
                            ?>
                            <option value="1">Hiện</option>
                            <option selected value="0">Ẩn</option>
                            <?php 
                            }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
               }
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


