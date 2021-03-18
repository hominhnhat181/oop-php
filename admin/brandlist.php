<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php

	// goi class category
	$brand = new brand();
	// nếu tồn tại delid này thì gán cho $id rồi truyền id vào hàm del_category và hàm này có chức năng xóa 
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		// goi ham vao bien delcat
		$delbrand = $brand->del_brand($id) ;
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách thương hiệu sản phẩm</h2>
                <div class="block">  
				<?php 
                if(isset($delbrand)){
                    echo $delbrand;
                }
                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php 
						$show_brand = $brand->show_brand();
						if($show_brand){
							$i = 0;
							while($result = $show_brand->fetch_assoc()){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['brandName'] ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandId'] ?>">Edit</a> || <a onclick = "return confirm('bạn có muốn xóa danh mục này')" href="?delid=<?php echo $result['brandId'] ?>">Delete</a></td>
						</tr>
					<?php
						}
					}
					?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

