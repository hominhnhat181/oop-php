<?php 
include 'inc/header.php'; 
?>
<?php
if(!isset($_GET['brandid']) || $_GET['brandid']==null){
    echo "<script>window.location = '404.php'</script>";
    }else{
	$id = $_GET['brandid'];
	}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
			<?php $getnamebrand = $brand->get_name_by_brand($id); 
				  if($getnamebrand){
					$result = $getnamebrand->fetch_assoc()

	
			?>
    		<h3><?php echo $result['brandName'] ?> </h3>
			<?php
				}
							
			?>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
			<?php 
			$producbybrand = $brand->get_product_by_brand_list($id);
			if($producbybrand){
				while($result_pdbrand = $producbybrand->fetch_assoc()){

				
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result_pdbrand['product_image'] ?>" alt="" /></a>
					 <h2><?php echo $result_pdbrand['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_pdbrand['product_desc'], 115) ?></p>
					 <p><span class="price"><?php echo $result_pdbrand['price']." VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_pdbrand['productId'] ?>" class="details">Details</a></span></div>
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