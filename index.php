<?php 

include 'inc/header.php'; 
include 'inc/slider.php'; 

?>


<div class="main">

    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>SẢN PHẨM MỚI</h3>
            </div>
            <div class="heading2" style="display:flex; margin-top: 10px; padding-left: 400px">
            <?php
						$get_brand = $brand->show_brand();
						if($get_cat){
							while($result_brand = $get_brand->fetch_assoc()){
						?>
						<div><a  class="a-top" href="productbybrand.php?brandid=<?php echo $result_brand['brandId'] ?>"><?php echo $result_brand['brandName'] ?></a></div>
						<?php
								}
							} 
						?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php 
                $product_new = $product->prd_brand_show();
                if($product_new){
                    while($result_new = $product_new->fetch_assoc()){

            ?>
            <div class="grid_1_of_4 images_1_of_4">
            <a href="details.php?proid=<?php echo $result_new['productId']?>" class="details"><img src="admin/uploads/<?php echo $result_new['product_image'] ?>" alt="" /></a>
            <a href="details.php?proid=<?php echo $result_new['productId']?>" class="details"> <h2><?php echo $result_new['productName'] ?></h2></a>
                <a class= "br_cat" href="productbybrand.php?brandid=<?php echo $result_new['brandId'] ?>"><h2><?php echo $result_new['brandName'] ?></h2></a>
               
                <p><span class="price"><?php echo $result_new['price']." VND" ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId']?>" class="details">Details</a></span></div>
            </div>
            <?php 
                    }
                }
            
            ?>
        </div>
        <div class="content_top">
            <div class="heading">
                <h3>Sản phẩm nổi bật</h3>
            </div>
            <div class="heading2" style="display:flex; margin-top: 10px; padding-left: 360px">
            <?php
						$get_brand = $brand->show_brand();
						if($get_cat){
							while($result_brand = $get_brand->fetch_assoc()){
						?>
						<div><a  class="a-top" href="productbybrand.php?brandid=<?php echo $result_brand['brandId'] ?>"><?php echo $result_brand['brandName'] ?></a></div>
						<?php
								}
							} 
						?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
        <?php 
            $product_feathered = $product->prd_brand_hide();
            if($product_feathered){
                while($result_feathered = $product_feathered->fetch_assoc()){

        ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details"><img src="admin/uploads/<?php echo $result_feathered['product_image'] ?>" alt="" /></a>
                <a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details"> <h2><?php echo $result_feathered['productName'] ?></h2></a>
                <a class= "br_cat" href="productbybrand.php?brandid=<?php echo $result_feathered['brandId'] ?>"><h2><?php echo $result_feathered['brandName'] ?></h2></a>
                <p><span class="price"><?php echo $result_feathered['price']." VND" ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details">Details</a></span></div>
            </div>

        <?php        
                }
            }
        ?>

        </div>
        <div class="content_top">
            <div class="heading">
                <h3>Khuyến mãi</h3>
            </div>
            <div class="heading2" style="display:flex; margin-top: 10px; padding-left: 440px">
            <?php
						$get_cat = $cat->show_category();
						if($get_cat){
							while($result_cat = $get_cat->fetch_assoc()){
						?>
						<div><a  class="a-top" href="productbycat.php?catid=<?php echo $result_cat['catId'] ?>"><?php echo $result_cat['catName'] ?></a></div>
						<?php
								}
							} 
						?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
        <?php 
            $product_feathered = $product->prd_brand_cat_sale();
            if($product_feathered){
                while($result_feathered = $product_feathered->fetch_assoc()){

        ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details"><img src="admin/uploads/<?php echo $result_feathered['product_image'] ?>" alt="" /></a>
                <a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details"> <h2><?php echo $result_feathered['productName'] ?></h2></a>
               
               
                <a class= "br_cat" href="productbycat.php?catid=<?php echo $result_feathered['catId'] ?>"><h2><?php echo $result_feathered['catName'] ?></h2></a>
                <a class= "br_cat" href="productbybrand.php?brandid=<?php echo $result_feathered['brandId'] ?>"><h2><?php echo $result_feathered['brandName'] ?></h2></a>
                <p><span class="price"><?php echo $result_feathered['price']." VND" ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details">Details</a></span></div>
            </div>

        <?php        
                }
            }
        ?>

        </div>
        <div class="content_top">
            <div class="heading">
                <h3>Top danh mục</h3>
            </div>
            <div class="heading2" style="display:flex; margin-top: 10px; padding-left: 440px">
            <?php
						$get_cat = $cat->show_category();
						if($get_cat){
							while($result_cat = $get_cat->fetch_assoc()){
						?>
						<div><a  class="a-top" href="productbycat.php?catid=<?php echo $result_cat['catId'] ?>"><?php echo $result_cat['catName'] ?></a></div>
						<?php
								}
							} 
						?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
        <?php 
            $product_feathered = $product->prd_brand_cat();
            if($product_feathered){
                while($result_feathered = $product_feathered->fetch_assoc()){

        ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details"><img src="admin/uploads/<?php echo $result_feathered['product_image'] ?>" alt="" /></a>
                <a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details"> <h2><?php echo $result_feathered['productName'] ?></h2></a>
                <a class= "br_cat" href="productbycat.php?catid=<?php echo $result_feathered['catId'] ?>"><h2><?php echo $result_feathered['catName'] ?></h2></a>
                <a class= "br_cat" href="productbybrand.php?brandid=<?php echo $result_feathered['brandId'] ?>"><h2><?php echo $result_feathered['brandName'] ?></h2></a>
                <p><span class="price"><?php echo $result_feathered['price']." VND" ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result_feathered['productId']?>" class="details">Details</a></span></div>
            </div>
        <?php        
                }
            }
        ?>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php'; 

?>