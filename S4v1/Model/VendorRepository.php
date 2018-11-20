<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 11:07 PM
 */

namespace Training\S4v1\Model;


use Training\S4v1\Api\Data\VendorInterface;
use Magento\Framework\Api\SortOrder;
use Training\S4v1\Api\VendorRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Training\S4v1\Model\TypeRepository;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Training\S4v1\Model\VendorFactory;
use Training\S4v1\Api\Data\VendorSearchResultsInterfaceFactory;
use Training\S4v1\Model\ResourceModel\Vendor as VendorResource;


class VendorRepository implements VendorRepositoryInterface
{
    protected $vendorFactory;

    protected $searchResultsInterfaceFactory;

    protected $collectionProcessorInterface;

    protected $filterBuilder;

    protected $joinProcessor;

    protected $productRepositoryInterface;

    protected $searchCriteriaBuilder;

    protected $typeRepository;

    protected $searchCriteriaInterface;

    protected $productInterfaceFactory;

    protected $vendorCollectionFactory;

    protected $vendorResource;


    public function __construct(
        VendorFactory $vendorFactory,
        VendorSearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        JoinProcessorInterface $joinProcessor,
         FilterBuilder $filterBuilder,
         SearchCriteriaBuilder $searchCriteriaBuilder,
        TypeRepository $typeRepository,
        SearchCriteriaInterface $searchCriteriaInterface,
        ProductRepositoryInterface $productRepository,
         ProductInterfaceFactory $productInterfaceFactory,
       VendorResource\CollectionFactory $collectionFactory,
        VendorResource $vendorResource

    )
    {
        $this->vendorFactory = $vendorFactory;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->typeRepository = $typeRepository;
        $this->searchCriteriaInterface = $searchCriteriaInterface;
        $this->productRepositoryInterface = $productRepository;
        $this->productInterfaceFactory = $productRepository;
        $this->vendorCollectionFactory = $collectionFactory;
        $this->vendorResource = $vendorResource;
    }

    public function get($value, $attributeCode = null)
    {
       $model = $this->vendorFactory->create()->load($value, $attributeCode);

       return $model;
    }


    public function getById($vendorId)
    {

        $model = $this->vendorFactory->create()->load($vendorId);


        return $model;

    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->vendorCollectionFactory->create();
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);

    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, VendorResource\Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, VendorResource\Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, VendorResource\Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }


    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, VendorResource\Collection  $collection)
    {
        $searchResults = $this->searchResultsInterfaceFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getData());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(VendorInterface $vendor)
    {
      $this->vendorResource->delete($vendor);
      return $this;
    }

    public function deleteById($id)
    {
      return $this->delete($this->getById($id));

    }

    public function save(\Training\S4v1\Api\Data\VendorInterface  $vendor)
    {

        try {
            $this->vendorResource->save($vendor);
        } catch (\Exception $exception) {
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->info($exception->getMessage());
        }

      return $vendor;

    }

    public function getListOfProductsByVendor()
    {
        $collections = $this->vendorFactory->create()->getCollection();
        $collections = $collections->getData();

        foreach ($collections as $collection) {
            $vendorId = $collection['vendor_id'];
            $product_id = $collection['product_id'];
            $productName = $this->productRepositoryInterface->getById($product_id)->getName();
            $product[] = [$vendorId, $product_id, $productName];
        }

        return $product;
    }

    public function getListOfVendorByProduct()
    {
        $collection = $this->vendorFactory->create()->getCollection();
        return $collection->getData();
    }


}