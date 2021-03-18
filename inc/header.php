<?php 
include 'lib/session.php';
// khởi tạo 1 ss mới
Session::init();
?>;

<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';

	//hàm này tự láy class name mà mình truyền vào
	spl_autoload_register(function($class){
		// mỗi lần khởi tạo sẽ tự động ic_o file trong folder classes
		include_once "classes/".$class.".php";
	});
	$db = new Database();
	$fm = new Format();
	$cat = new category();
	$brand = new brand();
	$product = new product();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>

<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="css/style.css">
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>

<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/123.png" style="width: 180px; height:120px" alt="" /></a>
			</div>
			
			<div class="header_top_right">
			<div class="title_n">
				<p>GOOD PRODUCT FOR GOOD PEOPLE</p>
			</div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li>
		  <a href="cat.php">Danh mục</a> 
		  <ul class="sub-menu">
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
		</li>
	  <li>
		  <a href="brand.php">Thương hiệu</a>
		  <ul class="sub-menu">
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
	</li>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>