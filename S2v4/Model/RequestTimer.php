<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/15/18
 * Time: 9:28 PM
 */

namespace Training\S2v4\Model;


class RequestTimer
{
    protected $timer = [];

    /**
     * @return $this
     */
    public function startTimer() {
        $this->timer = [
              'start' => microtime(true),
                'stop' => null,
                 'delta' => null
            ];
        return $this;
    }

    /**
     * @return $this
     */
    public function stopTimer() {
        if(empty($this->timer)) {
            $this->startTimer();
        }

        if($this->timer['stop']===null) {
            $this->timer['stop'] =   microtime(true);
            $this->timer['delta'] =  $this->timer['stop'] -  $this->timer['start'];
        }

        return $this;
    }

    public function getTimer() {
        return microtime(true);
    }

}