<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Itwapp\Service;

/**
 * Description of ItwappInitializer
 *
 * @author gael
 */
class ItwappInitializer implements Zend\ServiceManager\InitializerInterface
{
    public function initialize($instance, \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof \Itwapp\Service\Itwapp) {
            $instance->setClient(new GuzzleHttp\Client);
        }

        return $instance;
    }
}
