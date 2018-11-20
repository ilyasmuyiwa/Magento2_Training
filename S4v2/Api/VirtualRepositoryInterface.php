<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/20/18
 * Time: 9:17 PM
 */

namespace Training\S4v2\Api;


use Magento\Framework\Api\SearchCriteriaInterface;
use Training\S4v2\Api\Data\VirtualSearchResultsInterface;

interface VirtualRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface */
   public function getList(SearchCriteriaInterface $searchCriteria);
}