<?php
require __DIR__ . "/../../../web/vendor/autoload.php";
use Goutte\Client;
/**
 * Created by PhpStorm.
 * User: measylite
 * Date: 7/27/16  - Using Goutte instead of Guzzle
 * Time: 10:35 PM
 *
 * Run on command line: to test the script...
 *  vendor/bin/phpunit --colors ../src/Test/Controller/GameControllerTestTwo.php
 */

class GameControllerTestTwo extends PHPUnit_Framework_TestCase {

  /**
   * Goutte uses CSS sytle syntax
   * check that we are loading 10 ul li tags on our page.
   * assertCount the response and check/count ul tags
   */
  public function testIndex_HasUL() {
    $client = new Client();
    $response = $client->request('GET', 'http://localhost:8000/');
    $this->assertCount(10, $response->filter('ul > li'));
  }

  /**
   * Check for empty form, create an client and get a url
   * assert that we have one form
   * asset score field is empty
   * filter by attribute name call attr value to get the attribute
   */
  public function testAddRatint_WithGet_HasEmptyForm() {
    $client = new Client();
    $response = $client->request('GET', 'http://localhost:8000/add-rating.php?game=1');
    $this->assertCount(1, $response->filter('form'));
    $this->assertEquals('',$response->filter('form input[name=score]')->attr('value'));
  }

  /**
   * Test that our page is redirected and will update the database
   * We will use a Guzzle Client directly because we need to analise the headers.
   * Request is a POST,
   * allow_redirects => false : make sure the response is from the current page not the page redirect
   * form_parms is the data we are submitting "5" in this case
   *
   */
  public function  testAddRating_WithPost_isRedirect() {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'http://localhost:8000/add-rating.php?game=1',
      [
        'allow_redirects' => false,
        // 'form_params' => ['score' => '5'],
        'multipart' => [
          [
            'name' => 'score',
            'contents' => '5',
          ],
          [
            'name' => 'screenshot',
            'contents' => fopen(__DIR__.'/screenshot.jpg', 'r'),
          ],
        ]
      ]);
    $this->assertEquals(302, $response->getStatusCode()); // 302 = redirect
    $this->assertEquals('/', $response->getHeaderLine('Location'));

    $pdo = new PDO('mysql:host=localhost;dbname=measyPhpUnitTest', 'root', null);
    $stm = $pdo->prepare('SELECT * FROM rating');
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    $this->assertCount(1, $result);  //Expected returned data has no duplicates
    $this->assertEquals([ // compare arrays [] = []
      'user_id' => '1',
      'game_id' => '1',
      'score' => '5',
    ], $result[0]);
    // Check that file was placed in the right location
    $this->assertFileExists(__DIR__.'/../../../web/screenshots/1-1.jpg');
  }
}