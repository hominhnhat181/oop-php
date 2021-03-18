<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php

	// goi class category
	$cat = new category();
	// nếu tồn tại delid này thì gán cho $id rồi truyền id vào hàm del_category và hàm này có chức năng xóa 
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		// goi ham vao bien delcat
		$delcat = $cat->del_category($id) ;
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách danh mục sản phẩm</h2>
                <div class="block">  
				<?php 
                if(isset($delcat)){
                    echo $delcat;
                }
                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php 
						$show_cat = $cat->show_category();
						if($show_cat){
							$i = 0;
							while($result = $show_cat->fetch_assoc()){
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['catName'] ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId'] ?>">Edit</a> || <a onclick = "return confirm('bạn có muốn xóa danh mục này')" href="?delid=<?php echo $result['catId'] ?>">Delete</a></td>
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

