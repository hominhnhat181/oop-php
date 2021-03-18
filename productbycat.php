<?php 
include 'inc/header.php'; 
?>
<?php
if(!isset($_GET['catid']) || $_GET['catid']==null){
    echo "<script>window.location = '404.php'</script>";
    }else{
	$id = $_GET['catid'];
	}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
			<?php $getnamecat = $cat->get_name_by_cat($id); 
				  if($getnamecat){
					$result = $getnamecat->fetch_assoc()

	
			?>
    		<h3><?php echo $result['catName'] ?> </h3>
			<?php
							  }
							
			?>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
			<?php 
			$producbycat = $cat->get_product_by_cat($id);
			if($producbycat){
				while($result_pdcat = $producbycat->fetch_assoc()){
					
				
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result_pdcat['product_image'] ?>" alt="" /></a>
					 <h2><?php echo $result_pdcat['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_pdcat['product_desc'], 115) ?></p>
					 <p><span class="price"><?php echo $result_pdcat['price']." VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_pdcat['productId'] ?>" class="details">Details</a></span></div>
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