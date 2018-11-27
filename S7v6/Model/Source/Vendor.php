<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/27/18
 * Time: 8:37 PM
 */

namespace Training\S7v6\Model\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Training\S4v1\Api\VendorRepositoryInterfaceFactory;

class Vendor extends AbstractSource
{
    protected $searchCriteriaBuilder;
    protected $vendorRepository;
    public function __construct(
        VendorRepositoryInterfaceFactory $vendorRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->vendorRepository = $vendorRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getTable() {

    }

    public function getAllOptions()
    {
       $vendorRepository = $this->vendorRepository->create();
       $searchCriteria = $this->searchCriteriaBuilder->create();

       foreach ($vendorRepository->getList($searchCriteria)->getItems() as $item){
           $this->_options[] = [
               'label' => __($item['vendor_name']),
               'value' => $item['vendor_id']
           ];
       }

       return $this->_options;
    }

}