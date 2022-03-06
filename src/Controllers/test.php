<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

// read table products
$app->get('/test/{name}', function (Request $request, Response $response, 
array $arg){
 $name = $arg['name'];
 $response->getBody() -> write ("test $name");
 return $response;
});