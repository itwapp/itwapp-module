<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Itwapp\Service;
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
        $this->instance = new \Itwapp\Service\Itwapp();
        $this->instance->setServiceLocator($this->getMock('Zend\ServiceManager\ServiceManager'));

        $this->instance->getServiceLocator()
            ->expects($this->any())
            ->method('get')
            ->willReturn([
                'itwapp' => [
                    'base_url'  => 'http://itwapp.io',
                    'apiKey'    => 'test',
                    'secretKey' => md5('test')
                ]
            ])
        ;

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

    public function testBuildUrl()
    {
        $reflection = new \ReflectionClass(get_class($this->instance));
        $method = $reflection->getMethod('buildUrl');
        $method->setAccessible(true);

        $this->assertRegExp(
            "#http:\/\/itwapp.io\/api\/exemple\/\?apiKey=.*&timestamp=.*&signature=.*#",
            $method->invokeArgs($this->instance, ['/api/exemple/', 'GET'])
        );
    }

    public function testCreateInterview()
    {
        $response = $this->getMock('GuzzleHttp\Message\FutureResponse', [], [], '', false);
        $this->instance->getClient()->expects($this->once())
            ->method('post')
            ->willReturn($response)
        ;
        $response->expects($this->once())
            ->method('json')
            ->willReturn([
                '_id'       => '53fb562418060018063095db',
                'name'      => 'Test Interview',
                'questions' => [
                    [
                        "content"     => "question 1",
                        "readingTime" => 60,
                        "answerTime"  => 60,
                        "number"      => 1
                    ]
                ],
                'video'    => '',
                'text'     => '',
                'callback' => 'http://itwapp.io'
            ])
        ;
        $interview = $this->instance->createInterview(
            'Test Interview',
            [
                "content"     => "question 1",
                "readingTime" => 60,
                "answerTime"  => 60,
                "number"      => 1
            ],
            '',
            ''
        );
        $this->assertInstanceOf(
            'Itwapp\DAO\Interview',
            $interview
        );
        $this->assertEquals(
            '53fb562418060018063095db',
            $interview->getId()
        );

        return $interview;
    }

    public function testGetInterview()
    {
        $response = $this->getMock('GuzzleHttp\Message\FutureResponse', [], [], '', false);

        $response->expects($this->once())
            ->method('json')
            ->willReturn([
                '_id'       => '53fb562418060018063095db',
                'name'      => 'Test Interview',
                'questions' => [
                    [
                        "content"     => "question 1",
                        "readingTime" => 60,
                        "answerTime"  => 60,
                        "number"      => 1
                    ]
                ],
                'video'    => '',
                'text'     => '',
                'callback' => 'http://itwapp.io'
            ])
        ;

        $this->instance->getClient()->expects($this->once())
            ->method('get')
            ->willReturn($response)
        ;

        $interview = $this->instance->getInterview('53fb562418060018063095db');
        $this->assertInstanceOf('Itwapp\DAO\Interview', $interview);
        $this->assertEquals('Test Interview', $interview->getName());

        return $interview;
    }

    /**
     * @depends testCreateInterview
     */
    public function testCreateApplicant(\Itwapp\DAO\Interview $interview)
    {
        $responsePOST = $this->getMock('GuzzleHttp\Message\FutureResponse', [], [], '', false);
        $responseGET  = clone $responsePOST;

        $this->instance->getClient()->expects($this->once())
            ->method('post')
            ->willReturn($responsePOST)
        ;
        $this->instance->getClient()->expects($this->once())
            ->method('get')
            ->willReturn($responseGET)
        ;
        $responsePOST->expects($this->once())
            ->method('json')
            ->willReturn([
                '_id'         => '53fb562418060018063095db',
                'mail'        => 'jerome@itwapp.io',
                'questions'   => null,
                'responses'   => [
                    [
                        'file'     => 'http://video-prod-itwapp.s3.amazonaws.com/XXXXX/XXXX.mp4',
                        'duration' => 60,
                        'fileSize' => 1048576,
                        'number'   => 1
                    ]
                ],
                'interview'   => '53fb562418060018063095db',
                'dateBegin'   => 1409045626568,
                'dateEnd'     => 1409045926568,
                'dateAnswer'  => 1409046526568,
                'emailView'   => true,
                'linkClicked' => true,
                'firstname'   => 'Jérôme',
                'lastname'    => 'Heissler',
                'lang'        => 'fr',
                'videoLink'   => '',
                'text'        => '',
                'deleted'     => false,
                'callback'    => "http://itwapp.io",
                'status'      => 0
            ])
        ;
        $responseGET->expects($this->once())
            ->method('json')
            ->willReturn([
                '_id'       => '53fb562418060018063095db',
                'name'      => 'Test Interview',
                'questions' => [
                    [
                        "content"     => "question 1",
                        "readingTime" => 60,
                        "answerTime"  => 60,
                        "number"      => 1
                    ]
                ],
                'video'    => '',
                'text'     => '',
                'callback' => 'http://itwapp.io'
            ])
        ;

        $applicant = $this->instance->createApplicant(
            'jerome@itwapp.io',
            'fr',
            true,
            1409045626568,
            $interview
        );
        $this->assertInstanceOf(
            'Itwapp\DAO\Applicant',
            $applicant
        );
        $this->assertEquals(
            '53fb562418060018063095db',
            $applicant->getId()
        );
    }

    public function testGetApplicant()
    {
        $responseInterview = $this->getMock('GuzzleHttp\Message\FutureResponse', [], [], '', false);
        $responseApplicant = $this->getMock('GuzzleHttp\Message\FutureResponse', [], [], '', false);

        $responseApplicant->expects($this->once())
            ->method('json')
            ->willReturn([
                '_id'       => "53fb562418060018063095db",
                "mail"      => "jerome@itwapp.io",
                "questions" => [
                    [
                        "content"     => "question 1",
                        "readingTime" => 60,
                        "answerTime"  => 60,
                        "number"      => 1
                    ]
                ],
                "responses" => [
                    [
                      "file"     => "http://video-prod-itwapp.s3.amazonaws.com/XXXXX/XXXX.mp4",
                      "duration" => 60,
                      "fileSize" => 1048576,
                      "number"   => 1
                    ]
                ],
                "interview"   => "53fb562418060018063095da",
                "dateBegin"   => 1409045626568,
                "dateEnd"     => 1409045926568,
                "dateAnswer"  => 1409046526568,
                "emailView"   => true,
                "linkClicked" => true,
                "firstname"   => "Jérôme",
                "lastname"    => "Heissler",
                "lang"        => "fr",
                "videoLink"   => "",
                "text"        => "",
                "deleted"     => false,
                "callback"    => "http://itwapp.io",
                "status"      => 0
            ])
        ;

        $responseInterview->expects($this->once())
            ->method('json')
            ->willReturn([
                '_id'       => '53fb562418060018063095db',
                'name'      => 'Test Interview',
                'questions' => [
                    [
                        "content"     => "question 1",
                        "readingTime" => 60,
                        "answerTime"  => 60,
                        "number"      => 1
                    ]
                ],
                'video'    => '',
                'text'     => '',
                'callback' => 'http://itwapp.io'
            ])
        ;
        $this->instance->getClient()->expects($this->at(0))
            ->method('get')
            ->willReturn($responseApplicant)
        ;

        $this->instance->getClient()->expects($this->at(1))
            ->method('get')
            ->willReturn($responseInterview)
        ;

        $applicant = $this->instance->getApplicant('53fb562418060018063095db');
        $this->assertInstanceOf('Itwapp\DAO\Applicant', $applicant);
        $this->assertEquals('jerome@itwapp.io', $applicant->getMail());
        $this->assertEquals('53fb562418060018063095db', $applicant->getInterview()->getId());
    }
}