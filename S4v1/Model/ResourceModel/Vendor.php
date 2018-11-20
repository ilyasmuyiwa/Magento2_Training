<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\S4v1\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


/**
 * Cms page mysql resource
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Vendor extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('vendor', 'vendor_id');
    }


}