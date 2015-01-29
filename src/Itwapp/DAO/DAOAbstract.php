<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Itwapp\DAO;

/**
 * Description of DAOAbstract
 *
 * @author gael
 */
abstract class DAOAbstract
{
    /**
     * @return array
     */
    public function getData()
    {
        return get_object_vars($this);
    }

    /**
     * @param array $data
     *
     * @return \InterviewApp\DAO\DAOAbstract
     */
    public function setData(array $data)
    {
        foreach ($data as $attribute => $value) {
            $this->$attribute = $value;
        }

        return $this;
    }
}
