<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/22/18
 * Time: 9:17 AM
 */

namespace Training\S5v3\Model;

use Magento\Catalog\Api\Data\CategoryAttributeInterface;
use Training\S5v3\Api\BannerRepositoryInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Training\S5v3\Api\Data\BannerSearchResultsInterface;

class BannerRepository implements BannerRepositoryInterface
{
    protected $categoryFactory;
    protected $eavAttributeRepository;

    public function __construct(
        CategoryFactory $categoryFactory,
        AttributeRepositoryInterface $attributeRepository
    )
    {
        $this->categoryFactory = $categoryFactory;
        $this->eavAttributeRepository = $attributeRepository;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        return $this->eavAttributeRepository->getList(
            CategoryAttributeInterface::ENTITY_TYPE_CODE, $searchCriteria
        );
    }

}