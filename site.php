<?php 
use \Hcode\Page;
use \Hcode\Model\Product;
use \Hcode\Model\Category;
$app->get('/', function() {
	$products = Product::listAll();
    
	$page = new Page();
	$page->setTpl("index",array(
		"products"=>Product::checkList($products)
	));
});
$app->get("/categories/:idcategory", function($idcategory) {
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$category = new Category();
	$category->get((int)$idcategory);

	$page = new Page();
	$page->setTpl("category", array(
		"category"=>$category->getValues(),
		"products"=>Product::checkList($category->getProducts())
	));
});
$app->get("/products/:desurl", function($desurl) {
	$product = new Product();
	$product->getFromUrl($desurl);
	$page = new Page();
	$page->setTpl("product-detail", [
		'product'=>$product->getValues(),
		'categories'=>$product->getCategories()
	]);
});
$app->get("/cart", function(){
	$page = new Page();
	$page = setTpl("cart");
});

 ?>