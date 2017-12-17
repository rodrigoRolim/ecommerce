<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Product;

$app->get("/admin/products", function() {
	User::verifyLogin();

	$page = new PageAdmin();
	
	$products = Product::listAll();

	$page->setTpl("products", [
		"products"=>$products
	]);
});

$app->get("/admin/products/create", function() {
	User::verifyLogin();

	$page = new PageAdmin();
	
	$page->setTpl("products-create");
});

 ?>