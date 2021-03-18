<?php 

include 'inc/header.php'; 

?>
<?php 
if(!isset($_GET['proid']) || $_GET['proid']==null){
    echo "<script>window.location = '404.php'</script>";
}else
	$id = $_GET['proid'];
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<?php
				$get_product_detail = $product->get_details($id);
					if($get_product_detail){
						while($result_details = $get_product_detail->fetch_assoc()){
				?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['product_image'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'] ?> </h2>
					<p><?php echo $fm->textShorten($result_details['product_desc'], 100) ?></p>					
					<div class="price">
						<p>Giá: <span><?php echo $result_details['price']." VND" ?></span></p>
						<p>Danh mục: <span><?php echo $result_details['catName']  ?></span></p>
						<p>Thương hiệu:<span><?php echo $result_details['brandName']  ?></span></p>
					</div>
					<div class="add-cart">
						<form action="#" method="post">
							<input type="number" class="buyfield" name="" value="1"/>
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						</form>				
					</div>
				</div>
				<div class="product-desc">
				<h2>Chi tiết sản phẩm</h2>
				<p><?php echo $result_details['product_desc'] ?></p>
			</div>
		<?php
			}
		} 
		?>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>Danh Mục</h2>
					<ul>
						<?php
						$get_cat = $cat->show_category();
						if($get_cat){
							while($result_cat = $get_cat->fetch_assoc()){
						?>
						<li><a href="productbycat.php?catid=<?php echo $result_cat['catId'] ?>"><?php echo $result_cat['catName'] ?></a></li>
						<?php
								}
							} 
						?>
    				</ul>
 				</div>
				 <div class="rightsidebar span_3_of_1">
					<h2>Thương hiệu</h2>
					<ul>
						<?php
						$get_brand = $brand->show_brand();
						if($get_cat){
							while($result_brand = $get_brand->fetch_assoc()){
						?>
						
						<li><a href="productbybrand.php?brandid=<?php echo $result_brand['brandId'] ?>"><?php echo $result_brand['brandName'] ?></a></li>

						<?php
								}
							} 
						?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
<?php
include 'inc/footer.php'; 

?>