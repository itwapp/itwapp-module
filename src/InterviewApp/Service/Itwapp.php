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
class Itwapp implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \GuzzleHttp\Client $client
     * @return \InterviewApp\Service\Itwapp
     */
    public function setClient(\GuzzleHttp\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    public function createInterview($name, array $questions, $video, $text, $callback = 'http://itwapp.io')
    {
    }

    protected function buildUrl($action, $mode)
    {
        $config  = $this->getServiceLocator()->get('config');
        $action .= '?apiKey=' . $config['itwapp']['apiKey'] . '&timestamp=' . time();
        $hmac    = base64_encode(hash_hmac('sha256', $mode . ':' . $action, $config['itwapp']['secretKey'], true));

        return $config['itwapp']['base_url'] . '/' . $action . '&signature=' . md5($hmac);
    }
}
