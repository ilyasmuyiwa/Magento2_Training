<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/19/18
 * Time: 11:44 AM
 */

namespace Training\S4v1\Model\ResourceModel\Type;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Training\S4v1\Model\Type',
            'Training\S4v1\Model\ResourceModel\Type');
    }
}