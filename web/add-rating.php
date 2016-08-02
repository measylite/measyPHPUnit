<?php

require __DIR__ . "/../src/Repository/GameRepository.php";

$clean =[]; // Setup our array to hold our cleaned post and get data.
$clean['game'] = filter_var($_GET['game'], FILTER_SANITIZE_NUMBER_INT);

$repo = new GameRepository();
$game = $repo->findById($clean['game']);
//$game = $repo->findById($_GET['game']);
//echo var_dump($game);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $clean['score'] = filter_var($_POST['score'], FILTER_SANITIZE_NUMBER_INT);
  $clean['user'] = 1;
  $clean['screenshot'] = filter_var($_FILES['screenshot']['tmp_name'], FILTER_SANITIZE_STRING);
  $repo->saveGameRating($clean['game'], 1, $clean['score']);

  // grab file extension with pathinfo and move to new location
  $extension = pathinfo($clean['screenshot'], PATHINFO_EXTENSION);
  move_uploaded_file($clean['screenshot'], __DIR__.'/screenshots/'.$clean['game'].'-'.$clean['user'].'.jpg');

  header("Location: /");
  exit;
}
?>


<h1><?php echo $game->getTitle() ?> </h1>
<form method="post" enctype="multipart/form-data">
  <input type="number" name="score" min="1" max="5">
  <input type="file" name="screenshot">
  <input type="submit" value="Save">
</form>