<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 10:14 PM
 */

namespace Training\S4v1\Api;


use Magento\Framework\Api\SearchCriteriaInterface;
use Training\S4v1\Api\Data\VendorInterface;

interface VendorRepositoryInterface
{
    /**
     * @param int $value
     * @param null $attributeCode
     * @return \Training\S4v1\Api\Data\VendorInterface
     */
    public function get($value, $attributeCode = null );

    /**
     * @param int $vendorId
     * @return \Training\S4v1\Api\Data\VendorInterface
     */
    public function getById($vendorId);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * @param \Training\S4v1\Api\Data\VendorInterface $vendor
     * @return \Training\S4v1\Api\Data\VendorInterface
     */
    public function save(VendorInterface $vendor);

    /**
     * @param \Training\S4v1\Api\Data\VendorInterface $vendor
     * @return bool
     */
    public function delete(VendorInterface $vendor);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return  \Training\S4v1\Api\Data\VendorSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @return array
     */
    public function getListOfProductsByVendor();

    /**
     * @return array
     */
    public function getListOfVendorByProduct();

}