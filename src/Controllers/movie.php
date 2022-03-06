<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include movieProcedure.php file
include __DIR__ . '/../Controllers/function/movieProcedure.php';


//read table movie
$app->get('/movie', function (Request $request, Response $response, array$arg){
 return $this->response->withJson(array('data' => 'success'), 200);
});


// read all the data from table movie
$app->get('/allmovies',function (Request $request, Response $response, 
array $arg)
{
 $data = getAllMovies($this->db);
if (is_null($data)) {
 return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404);
}
return $this->response->withJson(array('data' => $data), 200);
});


//request table movie by condition (movie id)
$app->get('/movie/[{id}]', function ($request, $response, $args){
 
    $movieId = $args['id'];
    if (!is_numeric($movieId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);
    }
    $data = getMovie($this->db,$movieId);
    if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 500);
   }
    return $this->response->withJson(array('data' => $data), 200);
   });

   
   //insert new data
$app->post('/movie/add', function ($request, $response, $args) {

    $form_data = $request->getParsedBody();
    $data = createMovie($this->db, $form_data);

    if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200);
    }
   );


   //delete row in table movie
$app->delete('/movie/del/[{id}]', function ($request, $response, $args){
 
    $movieId = $args['id'];
   if (!is_numeric($movieId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
   }
   $data = deleteMovie($this->db,$movieId);
   if (empty($data)) {
   return $this->response->withJson(array($movieId=> 'is successfully deleted'), 202);};
   });


   //put or update table movie
   $app->put('/movie/put/[{id}]', function ($request, $response, $args){
    $movieId = $args['id'];
    $date = date("Y-m-j h:i:s");
    
   if (!is_numeric($movieId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
   }
    $form_dat=$request->getParsedBody();
    $data = updateMovie($this->db,$form_dat,$movieId,$date);

   if ($data <=0)

   return $this->response->withJson(array('data' => 'successfully updated'), 200);
});

    