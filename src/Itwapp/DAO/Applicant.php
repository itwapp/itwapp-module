<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace InterviewApp\DAO;

/**
 * Description of Applicant
 *
 * @author gael
 */
class Applicant extends DAOAbstract
{
    /**
     * @var string
     */
    protected $_id;

    /**
     * @var string
     */
    protected $mail;

    /**
     * @var array
     */
    protected $questions;

    /**
     * @var array
     */
    protected $responses;

    /**
     * @var \InterviewApp\DAO\Interview
     */
    protected $interview;

    /**
     * @var \Datetime
     */
    protected $dateBegin;

    /**
     * @var \Datetime
     */
    protected $dateEnd;

    /**
     * @var \Datetime
     */
    protected $dateAnswer = null;

    /**
     * @var bool
     */
    protected $emailView;

    /**
     * @var bool
     */
    protected $linkedClicked;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $lang;

    /**
     * @var string
     */
    protected $videoLink;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var bool
     */
    protected $deleted;

    /**
     * @var string
     */
    protected $callback;

    /**
     * @var int
     */
    protected $status;

    public function __construct()
    {
        $this->questions = [];
        $this->responses = [];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return array
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @return array
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @return \InterviewApp\DAO\Interview
     */
    public function getInterview()
    {
        return $this->interview;
    }

    /**
     * @return \Datetime
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * @return \Datetime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @return \Datetime
     */
    public function getDateAnswer()
    {
        return $this->dateAnswer;
    }

    /**
     * @return bool
     */
    public function getEmailView()
    {
        return $this->emailView;
    }

    /**
     * @return bool
     */
    public function getLinkedClicked()
    {
        return $this->linkedClicked;
    }

    /**
     * @return bool
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function getVideoLink()
    {
        return $this->videoLink;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return bool
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @return string
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $id
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setId($id)
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * @param int $mail
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @param array $questions
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setQuestions(array $questions = [])
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * @param array $responses
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setResponses(array $responses = [])
    {
        $this->responses = $responses;

        return $this;
    }

    /**
     * @param \InterviewApp\DAO\Interview $interview
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setInterview(Interview $interview)
    {
        $this->interview = $interview;

        return $this;
    }

    /**
     * @param \DateTime $dateBegin
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setDateBegin(\DateTime $dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * @param \DateTime $dateEnd
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setDateEnd(\DateTime $dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @param \DateTime $dateAnswer
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setDateAnswer(\DateTime $dateAnswer = null)
    {
        $this->dateAnswer = $dateAnswer;

        return $this;
    }

    /**
     * @param bool $emailView
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setEmailView($emailView)
    {
        $this->emailView = $emailView;

        return $this;
    }

    /**
     * @param bool $linkedClicked
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setLinkedClicked($linkedClicked)
    {
        $this->linkedClicked = $linkedClicked;

        return $this;
    }

    /**
     * @param string $firstname
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @param string $lastname
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @param string $videoLink
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setVideoLink($videoLink)
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    /**
     * @param string $text
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param bool $deleted
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * @param string $callback
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setCallback($callback = 'http://itwapp.io')
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @param int $status
     *
     * @return \InterviewApp\DAO\Applicant
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function setData(array $data)
    {
        parent::setData($data);
        $this->setDateAnswer(($data['dateAnswer'] == 0) ? null : (new \DateTime())->setTimestamp($data['dateAnswer']));
        $this->setDateBegin((new \DateTime)->setTimestamp($data['dateBegin']));
        $this->setDateEnd((new \DateTime)->setTimestamp($data['dateEnd']));
        $this->setInterview($data['interview']);

        return $this;
    }
}