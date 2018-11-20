<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/20/18
 * Time: 9:22 PM
 */

namespace Training\S4v2\Model;


use Magento\Framework\Api\SearchCriteriaInterface;
use Training\S4v2\Api\Data\VirtualSearchResultsInterfaceFactory;
use Training\S4v2\Api\VirtualRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Api\ProductCustomOptionRepositoryInterface;

class VirtualRepository implements VirtualRepositoryInterface
{
    protected $productInterface;
    protected $productRepository;
    protected $productCustomOption;
    protected $searchResultsInterfaceFactory;

    public function __construct(
        ProductInterface $productInterface,
        ProductRepository $productRepository,
        ProductCustomOptionRepositoryInterface $productCustomOption,
        VirtualSearchResultsInterfaceFactory $searchResults
    )
    {;
        $this->productRepository = $productRepository;
        $this->productInterface = $productInterface;
        $this->productCustomOption = $productCustomOption;
        $this->searchResultsInterfaceFactory = $searchResults;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $products = [];
        $productRepository = $this->productRepository->getList($searchCriteria);
        $searchResults = $this->searchResultsInterfaceFactory->create();

        foreach ($productRepository->getItems() as $product){
            foreach ($this->productCustomOption->getProductOptions($product) as $option) {
                $option->setProduct($product);
                $product->setOptions($option->getData());
                $products[] = $product->getData();
            }
        }

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($products);
        $searchResults->setTotalCount(count($products));
        return $searchResults;

    }
}