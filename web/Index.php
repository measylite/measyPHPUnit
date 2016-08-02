<?php
/**
 * Created by PhpStorm.
 * User: measylite
 * Date: 7/22/16
 * Time: 10:27 PM
 */


require __DIR__ . "/../src/Repository/GameRepository.php";

$repo = new GameRepository();
$games = $repo->findByUserId(1);

//echo '<pre>';
//var_dump($games);
//echo '</pre>';
?>

<!--Load our one picture through GameRepository-->
<ul> <?php foreach ($games as $game): ?>
  <li>
      <?php echo $game->getTitle(); ?> <br />
    <?php echo $game->getRating(); ?> <br />
    <img src="<?php echo $game->getImagePath(); ?>">
  </li>
  <?php endforeach ?> <br>
</ul>

