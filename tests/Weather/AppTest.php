<?php


use TripleI\Weather\App;

class AppTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Weather\App
     **/
    private $app;


    /**
     * セットアップ 
     *
     * @return void
     **/
    public function setUp ()
    {
        $this->app = new App();
    }



    /**
     * @test
     * @expectedException   Exception
     * @expectedMessage     地名を指定してください
     * @group app-validate
     */
    public function 引数が不足している ()
    {
        $params = array();
        $result = $this->app->execute($params);
    }



    /**
     * @test
     * @expectedException   Exception
     * @expectedMessage     APIに適さない地名です
     * @group app-getcityid
     **/
    public function ふさわしくない地名を指定する ()
    {
        $params = array(null, '蒲郡');
        $result = $this->app->execute($params);
    }



    /**
     * @test
     * @group app
     */
    public function 正しい処理 ()
    {
        $params = array(null, '豊橋');
        $result = $this->app->execute($params);

        $this->assertTrue(is_string($result));
    }
}
