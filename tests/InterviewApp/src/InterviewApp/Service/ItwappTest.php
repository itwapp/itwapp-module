<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace InterviewApp\Service;
/**
 * Description of Itwapp
 *
 * @author gael
 */
class ItwappTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \InterviewApp\Service\Itwapp
     */
    protected $instance;

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    public function setUp()
    {
        $this->instance = new \InterviewApp\Service\Itwapp();
        $this->client   = $this->getMock('\GuzzleHttp\Client', [], [], '', false);

        $this->instance->setClient($this->client);
    }

    public function testSetClient()
    {
        $this->client = $this->getMock('\GuzzleHttp\Client', [], [], '', false);

        $this->assertSame($this->instance, $this->instance->setClient($this->client));
    }

    public function testGetClient()
    {
        $this->assertSame($this->client, $this->instance->getClient());
    }

    public function testBuildSignature()
    {
        $url       = '/api/exemple?foo=bar&apiKey=YOUR_KEY_HERE&timestamp=CURRENT_TIMESTAMP_MILLIS';
        $mode      = 'GET';
        $secretKey = md5('test');

        $reflection = new \ReflectionClass(get_class($this->instance));
        $method = $reflection->getMethod('buildSignature');
        $method->setAccessible(true);

        $this->assertEquals('55f8ec9b3e2bcbb2f4dc67ff7ded2bf6', $method->invokeArgs($this->instance, [$url, $mode, $secretKey]));
    }
}