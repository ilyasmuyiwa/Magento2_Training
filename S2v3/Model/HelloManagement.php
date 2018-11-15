<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/15/18
 * Time: 8:02 PM
 */

namespace Training\S2v3\Model;


use Training\S2v3\Api\HelloManagementInterFace;

class HelloManagement implements HelloManagementInterFace
{
  public function sayHello($id, $info)
  {
    if (isset($info['firstname']) && isset($info['lastname'])) {
        return sprintf('Help %s %s', $info['firstname'],  $id);
    }

    return "Error";
  }
}