<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/21/18
 * Time: 12:44 AM
 */

namespace Training\S4v2\Controller\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\App\ActionInterface;

class Index implements ActionInterface
{
    protected $productRepository;
    protected $searchCriteriaBuilder;
    protected $filterBuilder;

    public function __construct(ProductRepositoryInterface $productRepository,
                        SearchCriteriaBuilder $searchCriteriaBuilder,
                        FilterBuilder $filterBuilder
    )
    {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;

    }

    public function execute()
    {
       $product = $this->productRepository->getList($this->searchCriteriaBuilder->create());
       var_dump($product->getItems()[4]->getData());

       die('ds');
    }
}