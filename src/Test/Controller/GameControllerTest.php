<?php
/**
 * Created by PhpStorm.
 * User: measylite
 * Date: 7/27/16
 * Time: 8:55 PM
 */

require __DIR__ . "/../../../web/vendor/autoload.php";
use GuzzleHttp\Client;

class GameControllerTest extends PHPUnit_Framework_TestCase {

  public function testIndex_HasUL() {
    $client = new Client();
    // send the request check for ul tags
    $response = $client->request('GET', 'http://localhost:8000/');
    $this->assertRegExp('/<ul>/', $response->getBody()->getContents());
  }

}