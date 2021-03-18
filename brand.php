<?php 

include 'inc/header.php'; 
include 'inc/slider.php'; 

?>
 <div class="main">
    <div class="content">
		<?php 
			$getbrName = $brand->show_brand();
			if($getbrName){

				while($result_brand = $getbrName->fetch_assoc()){
					$id = $result_brand['brandId'];
		?>
    	<div class="content_top">
    		<div class="heading">
    		<a  href="productbybrand.php?brandid=<?php echo $result_brand['brandId'] ?>"><h3><?php echo $result_brand['brandName'] ?></h3></a>
    		</div>
    		<div class="clear"></div>
		</div>
	      <div class="section group">
			  <?php 
				 $getpd_bybrand =$brand->get_product_by_brand($id);
				 if($getpd_bybrand){
					 while($result_pd = $getpd_bybrand->fetch_assoc()){ 
			  ?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-3.php"><img src="admin/uploads/<?php echo $result_pd['product_image'] ?>" alt="" /></a>
					 <h2><?php echo $result_pd['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_pd['product_desc'], 90) ?></p>
					 <p><span class="price"><?php echo $result_pd['price']." VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_pd['productId'] ?>" class="details">Details</a></span></div>
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