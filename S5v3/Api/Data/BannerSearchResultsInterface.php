<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/20/18
 * Time: 9:11 PM
 */

namespace Training\S5v3\Api\Data;

interface BannerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items);

}