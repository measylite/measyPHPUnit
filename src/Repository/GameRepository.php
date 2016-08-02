<?php
/**
 * Created by PhpStorm.
 * User: measylite
 * Date: 7/22/16
 * Time: 8:26 PM
 */

require __DIR__ . "/../Entity/Game.php";
class GameRepository {

  protected $pdo;

  public function __construct() { // use pdo to connect to the db, user root and null password.
    $this->pdo = new PDO(
      'mysql:host=localhost;dbname=measyPhpUnitTest', 'root', null
    );
  }//End Constructor

  /**
   * @param $id
   * @return mixed
   */
  public function findById($id) {
    // method to load the game we need to add a rating too
    $stm = $this->pdo->prepare('SELECT * FROM game WHERE id = ?');
    $stm->execute([$id]); //array of args to replace ?
  // Use fetchObject to mach database column name to object properties
    $game = $stm->fetchObject('Game');
    return $game;
  }//end findById()

  public function  saveGameRating($gameId, $userId, $score) {
    // method to save ratings we use replace instead of insert
    $stm = $this->pdo->prepare(
      'REPLACE INTO rating (game_id, user_id, score)
        VALUES (?,?,?)');
    return $stm->execute([$gameId,$userId, $score]);
  }// end saveGameRating()

  public function findByUserId($id) {
    $games = [];
    for($i = 1; $i <= 10; $i++) {
      $game = new Game();
      $game->setTitle("Game " . $i);
      $game->setImagePath("/images/placeholder.jpg");
      $game->setRating(4.5);
      $games[] = $game;
    }//end For
    return $games;
  }//end findByUser

}//end Game