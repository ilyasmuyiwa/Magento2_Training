<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 10:14 PM
 */

namespace Training\S4v1\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Training\S4v1\Api\Data\TypeInterface;
interface TypeRepositoryInterface
{

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);

    /**
     * @param TypeInterface $vendor
     * @return mixed
     */
    public function save(TypeInterface $vendor);

    /**
     * @param TypeInterface $vendor
     * @return mixed
     */
    public function delete(TypeInterface $vendor);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return  \Training\S4v1\Api\Data\VendorSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);



}