<?php
namespace Training\S4v1\Model;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\GiftMessage\Model\TypeFactory;
use Training\S4v1\Api\Data\TypeInterface;
use Training\S4v1\Api\Data\TypeSearchResultsInterface;
use Training\S4v1\Api\Data\TypeSearchResultsInterfaceFactory;
use Training\S4v1\Model\ResourceModel\Type\CollectionFactory as TypeCollectionFactory;
use Training\S4v1\Model\ResourceModel\Type\Collection;
use Training\S4v1\Api\TypeRepositoryInterface;
use Training\S4v1\Model\ResourceModel\Type as TypeResource;

class TypeRepository implements TypeRepositoryInterface
{
    /**
     * @var Type
     */
    private $typeFactory;

    /**
     * @var TypeCollectionFactory
     */
    private $typeCollectionFactory;

    /**
     * @var TypeSearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    protected $typeResource;

    public function __construct(
        TypeFactory $typeFactory,
        TypeCollectionFactory $typeCollectionFactory,
        TypeSearchResultsInterfaceFactory $typeSearchResultInterfaceFactory,
        TypeResource $typeResource
    ) {
        $this->typeFactory = $typeFactory;
        $this->typeCollectionFactory = $typeCollectionFactory;
        $this->searchResultFactory = $typeSearchResultInterfaceFactory;
        $this->typeResource = $typeResource;
    }

    // ... getById, save and delete methods listed above ...

    public function getList(SearchCriteriaInterface $searchCriteria)
    {

        // if($searchCriteria = null) {
        // 	die('null found');
        // }
        $collection = $this->typeCollectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
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

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(TypeInterface $type)
    {
        $this->typeResource->delete($type);

        return $this;
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));

    }

    public function save(TypeInterface $type)
    {
        $this->typeResource->save($type);

        return $this;

    }

    public function getById($id)
    {
        $model = $this->typeFactory->create()->load($id);

        return $model;
    }
}