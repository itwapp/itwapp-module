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

    public function createInterview($name, array $questions, $video = '', $text = '', $callback = 'http://itwapp.io')
    {
        $url       = $this->buildUrl('api/v1/interview/', 'POST');

        $response  = $this->getClient()->post(
            $url,
            [
                'json' => [
                    'name'      => $name,
                    'questions' => $questions,
                    'video'     => $video,
                    'text'      => $text,
                    'callback'  => $callback,
                ],
                'exceptions' => false
            ]
        );

        return (new \Itwapp\DAO\Interview())->setData($response->json());
    }

    public function getInterview($id)
    {
        $url       = $this->buildUrl('api/v1/interview/'.$id, 'GET');

        $response  = $this->getClient()->get($url);

        return (new \Itwapp\DAO\Interview())->setData($response);
    }

    public function createApplicant($mail, $lang, $alert, $deadline, \Itwapp\DAO\Interview $interview,
        array $questions = [], $message = null, $lastname = null, $firstname = null, $videoLink = null,
        $textIntro = null, $callback = 'http://itwapp.io'
    ) {
        $url       = $this->buildUrl('api/v1/applicant/', 'POST');

        $response  = $this->getClient()->post(
            $url,
            [
                'json' => [
                    'mail'          => $mail,
                    'lang'          => $lang,
                    'alert'         => $alert,
                    'deadline'      => $deadline,
                    'interview'     => $interview->getId(),
                    'questions'     => $questions,
                    'message'       => $message,
                    'lastname'      => $lastname,
                    'firstname'     => $firstname,
                    'interviewName' => $interview->getName(),
                    'videoLink'     => $videoLink,
                    'textIntro'     => $textIntro,
                    'callback'      => $callback
                ],
                'exceptions' => false
            ]
        );

        $data              = $response->json();
        $data['interview'] = $this->getInterview($data['interview']);

        return (new \Itwapp\DAO\Applicant())->setData($data);
    }

    protected function buildUrl($action, $mode)
    {
        $config  = $this->getServiceLocator()->get('config');
        $action .= '?apiKey=' . $config['itwapp']['apiKey'] . '&timestamp=' . time();
        $hmac    = base64_encode(hash_hmac('sha256', $mode . ':' . $action, $config['itwapp']['secretKey'], true));

        return $config['itwapp']['base_url'] . '/' . $action . '&signature=' . md5($hmac);
    }
}
