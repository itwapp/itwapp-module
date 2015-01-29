<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Itwapp\DAO;

/**
 * Description of Interview
 *
 * @author gael
 */
class Interview extends DAOAbstract
{
    /**
     * @var int
     */
    protected $_id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $questions;

    /**
     * @var string
     */
    protected $video;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $callback = 'http://itwapp.io';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = [];
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getQuestions()
    {
        return $this->questions;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getCallback()
    {
        return $this->callback;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setQuestions(array $questions)
    {
        $this->questions = $questions;
    }

    public function setVideo($video)
    {
        $this->video = $video;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setCallback($callback)
    {
        $this->callback = $callback;
    }
}