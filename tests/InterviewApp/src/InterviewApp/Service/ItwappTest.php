<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Itwapp
 *
 * @author gael
 */
class Itwapp extends PHPUnit_Framework_TestCase
{
    protected $instance;

    public function setUp()
    {
        $this->instance = new \InterviewApp\Service\Itwapp();
    }

    public function testCreateInterview()
    {
        $interview = $this->instance->createInterview([
            "name"      => "Assessfirst Interview",
            "questions" => [
                [
                    "content"     => "question 1",
                    "readingTime" => 60,
                    "answerTime"  => 60,
                    "number"      => 1
                ]
            ],
            "video"     => "",
            "text"      => "",
            "callback"  => "http://myurl.com/done"
        ]);
        $this->assertInstanceOf('\Interview', $interview);
    }

    public function testGetApplicant()
    {
        $this->assertSame($this->instance->createApplicant(), $this->instance->getApplicant());
    }

//    public function testCreateApplicant()
//    {
//        $applicant = $this->instance->createApplicant([
//            'mail'      => 'test@test.fr',
//            $interview, $dateBegin, $dateEnd, $dateAnswer, $emailView, $linkClicked, $firstname, $lastname, $lang, $videoLink, $text, $deleted, $callback = "http://itwapp.io"
//        ]);
//        $this->assertInstanceOf('\Applicant', $this->instance->createApplicant());
//    }
//
//    public function testGetInterview()
//    {
//        $this->assertInstanceOf('\Interview', $this->instance->getApplicant());
//    }
}

class ApplicantStub extends Applicant
{

}
