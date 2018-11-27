<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/20/18
 * Time: 9:17 PM
 */

namespace Training\S5v3\Api;


interface BannerRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Eav\Api\Data\AttributeSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}