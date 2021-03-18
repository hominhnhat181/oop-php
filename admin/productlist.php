<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>

<?php 

	$pd = new product();
	$fm = new Format();
	if(isset($_GET['productid'])){
		$id = $_GET['productid'];
		// goi ham vao bien delcat
		$delpro = $pd->del_product($id) ;
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">  
				<?php 
                if(isset($delpro)){
                    echo $delpro;
                }
                ?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên Sản Phẩm</th>
					<th>Giá Sản Phẩm</th>
					<th>Ảnh</th>
					<th>Danh Mục</th>
					<th>Thương Hiệu</th>
					<th>Mô Tả</th>
					<th>Nổi Bật</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody>
			<?php


			// gọi hàm từ biến pd rồi truyền vào biến pdlist
			$pdlist =$pd->show_product();
			// nếu láy ra được pdlist
			if($pdlist){
				$i = 0;
				while($result = $pdlist->fetch_assoc()){
					$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td> <img src="uploads/<?php echo $result['product_image'] ?>" width="80px" height="120px"></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><?php echo $fm->textShorten($result['product_desc'], 30) ?></td>
					<td><?php 
					if($result['product_type'] == 0){
						echo 'Ẩn';
					}else{
						echo 'Hiện';
					}
					?></td>
					<!-- thêm đường dẫn từ đây thì bên productedit form action k cần truyền  -->
					<td><a href="productedit.php?productid=<?php echo $result['productId']?>">Edit</a> || <a href="?productid=<?php echo $result['productId']?>">Delete</a></td>
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
