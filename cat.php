<?php 

include 'inc/header.php'; 
include 'inc/slider.php'; 

?>
 <div class="main">
    <div class="content">
		<?php 
			$getcatName = $cat->show_category();
			if($getcatName){
				while($result_catName = $getcatName->fetch_assoc()){
					$id = $result_catName['catId'];
		?>
    	<div class="content_top">
    		<div class="heading">
    		<a href="productbycat.php?catid=<?php echo $result_catName['catId'] ?>"><h3><?php echo $result_catName['catName'] ?></h3></a>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php 
				 $getpd_bycat = $cat->get_product_by_cat($id);
				 if($getpd_bycat){
					 while($result_pd_by_cat = $getpd_bycat->fetch_assoc()){

			  ?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="preview-3.php"><img src="admin/uploads/<?php echo $result_pd_by_cat['product_image'] ?>" alt="" /></a>
					 <h2><?php echo $result_pd_by_cat['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_pd_by_cat['product_desc'], 90) ?></p>
					 <p><span class="price"><?php echo $result_pd_by_cat['price']." VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_pd_by_cat['productId'] ?>" class="details">Details</a></span></div>
				</div>
					<?php 
							 }
						}
					?>
			</div>
			<?php 
							}
						}
			?>
    </div>
 </div>
 <?php
include 'inc/footer.php'; 

?>