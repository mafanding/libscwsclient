<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Fenton\Scws\Client;

final class ClientTest extends TestCase
{

    /**
     * @test
     */
    public function getInstance()
    {
        $instance = Client::getInstance();
        $this->assertInstanceOf(Client::class, $instance);
        return $instance;
    }

    /**
     * @test
     * @depends getInstance
     */
    public function setCharset(Client $instance)
    {
        $this->assertTrue($instance->setCharset("utf-8"));
    }

    /**
     * @test
     * @depends getInstance
     */
    public function addDict(Client $instance)
    {
        $this->assertTrue($instance->addDict("/etc/scws/dict.utf8.xdb"));
    }

    /**
     * @test
     * @depends getInstance
     */
    public function setDict(Client $instance)
    {
        $this->assertTrue($instance->setDict("/etc/scws/dict.utf8.xdb"));
    }

    /**
     * @test
     * @depends getInstance
     */
    public function setRule(Client $instance)
    {
        $this->assertTrue($instance->setRule("/etc/scws/rules.utf8.ini"));
    }

    /**
     * @test
     * @depends getInstance
     */
    public function setIgnore(Client $instance)
    {
        $this->assertTrue($instance->setIgnore(true));
    }

    /**
     * @test
     * @depends getInstance
     */
    public function setMulti(Client $instance)
    {
        $this->assertTrue($instance->setMulti(Client::MULTI_ZALL));
    }

    /**
     * @test
     * @depends getInstance
     */
    public function setDuality(Client $instance)
    {
        $this->assertTrue($instance->setDuality(true));
    }

    /**
     * @depends getInstance
     */
    public function testGetResult(Client $instance)
    {
        $result = $instance->getResult("test");
        $this->assertInternalType("array", $result);
        return $instance;
    }

    /**
     * @test
     * @depends testGetResult
     */
    public function getTops(Client $instance)
    {
        $result = $instance->getTops("t");
        $this->assertInternalType("array", $result);
    }

}
