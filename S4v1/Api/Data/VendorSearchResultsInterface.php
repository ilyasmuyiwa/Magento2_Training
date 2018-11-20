<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 10:09 PM
 */

namespace Training\S4v1\Api\Data;


interface VendorSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param \Training\S4v1\Api\Data\VendorInterface[]
     * @return $this
     */
    public function setItems(array $items);
}