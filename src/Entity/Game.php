<?php
/**
 * Created by PhpStorm.
 * User: measylite
 * Date: 7/22/16
 * Time: 8:38 PM
 */

class Game {
  protected $title;
  protected $imagePath;
  protected $rating;

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($val) {
   $this->title = $val;
  }

  public function  getImagePath() {
    if ($this->imagePath == null) {
      return $this->imagePath = "/images/placeholderDefault.jpg";
    }
    return $this->imagePath;
  }

  public function  setImagePath($val) {
    $this->imagePath = $val;
  }

  public  function getRating() {
    return $this->rating;
  }

  public  function setRating($val) {
    $this->rating = $val;
  }

  /*
   * TODO
   * Using test doubles we do not need to write our getAverageScore() function yet
   */
  public function isRecommended() {
    return $this->getAverageScore() >=3;
  }

}//end Game()