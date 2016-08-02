<?php
/**
 * User: Measy Lite
 * Date: 7/22/16
 * Time: 11:40 PM
 *
 *  Each test should have its own/separate function and must begin with the word test
 *  Run our test from the command line:
 *    vendor/bin/phpunit --colors ../src/Test/Unit/GameTest.php
 */

require __DIR__ . "/../../Entity/Game.php";

class GameTest extends PHPUnit_Framework_TestCase {

  public function testImage_WithNull_ReturnsPlaceHolder () {    //  Naming = Image is what we are testing , checking for state and returning a place holder
    $game = new Game();
    $game->setImagePath(null); // set path to null
    $this->assertEquals('/images/placeholderDefault.jpg', $game->getImagePath());  // 1 parameter expected url, 2nd param actual path
  }// end testImage()

  // Test Path provided is other than null
  public function testImage_WithPath_ReturnsPath () {
    $game = new Game();
    $game->setImagePath('/images/NameOfImage.jpg');
    $this->assertEquals('/images/NameOfImage.jpg', $game->getImagePath());  // 1 parameter expected url, 2nd param actual path
  }// end testImage()

  /**
   * Fill in with a stunt double - Override the getAverageScore() method with: getMockBuilder(class , [functionName])
   */
  public function testIsRecommended_With5_ReturnsTrue() {
//    $game = $this->getMock('Game', ['getAverageScore']);
//    $game->method('getAverageScore')->willReturn(5); //pretend it exist
//    $this->assertTrue($game->isRecommended());
    $game = $this->createMock('Game', ['gerAverageScore']);
    $game->method('getAverageScore')->willReturn(5);
    $this->assertTrue($game->isRecommended());
  }

}//End GameTest

