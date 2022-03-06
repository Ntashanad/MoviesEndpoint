<?php


//get all movies
function getAllMovies($db)
{
$sql = 'Select m.titles, m.year, m.run_time, m.genre, l.name as language from movie m ';
$sql .='Inner Join languages l on m.language_id = l.id';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get movie by id
function getMovie($db, $movieId)
{
$sql = 'Select m.titles, m.year, m.run_time, m.genre, l.name as language from movie m ';
$sql .= 'Inner Join languages l on m.language_id = l.id ';
$sql .= 'Where m.id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $movieId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new movie
function createMovie($db, $form_data) {
    $sql = 'Insert into movie (titles, year, run_time, language_id, genre, date_release) ';
    $sql .= 'values (:titles, :year, :run_time, :language_id, :genre, :date_release)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':titles', $form_data['titles']);
    $stmt->bindParam(':year', ($form_data['year']));
    $stmt->bindParam(':run_time', ($form_data['run_time']));
    $stmt->bindParam(':language_id', ($form_data['language_id']));
    $stmt->bindParam(':genre', $form_data['genre']);
    $stmt->bindParam(':date_release', $form_data['date_release']);
    $stmt->execute();
    return $db->lastInsertID(); //insert last number.. continue
}   


   //delete movie by id
function deleteMovie($db,$movieId) {
    $sql = ' Delete from movie where id = :id';
    $stmt = $db->prepare($sql);
    $id = (int)$movieId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    }


    //update product by id
    function updateMovie($db,$form_dat,$movieId,$date) 
    {
        $sql = 'UPDATE movie SET titles = :titles , year = :year ,
       run_time = :run_time , language_id = :language_id , genre = :genre , modified = :modified ';
        $sql .=' WHERE id = :id';
        $stmt = $db->prepare ($sql);
        $id = (int)$movieId;
        $mod_d = $date;
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titles', $form_dat['titles']);
        $stmt->bindParam(':year', ($form_dat['year']));
        $stmt->bindParam(':run_time', ($form_dat['run_time']));
        $stmt->bindParam(':language_id', ($form_dat['language_id']));
        $stmt->bindParam(':genre', $form_dat['genre']);
        $stmt->bindParam(':modified', $mod_d , PDO::PARAM_STR);
        $stmt->execute();
        }
    