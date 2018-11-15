<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/15/18
 * Time: 8:01 PM
 */

namespace Training\S2v3\Api;


interface HelloManagementInterFace
{
    /**
     * @param int $id
     * @param string[] array $info
     * @return string
     */
    public function sayHello ($id, $info);
}