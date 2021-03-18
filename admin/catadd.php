<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php

// new class(not file)
 $cat = new category();
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
	 $catName = $_POST['catName'];
	// goi ham tu category.php
	 $insertCat = $cat->insert_category($catName) ;
 }


?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
               <div class="block copyblock"> 
               <?php 
                // nếu có insertCat thì in ra 
                if(isset($insertCat)){
                    echo $insertCat;
                }
                ?>
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="catName" placeholder="Tên danh mục mới..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>