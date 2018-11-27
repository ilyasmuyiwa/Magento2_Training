<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/24/18
 * Time: 10:15 PM
 */

namespace Training\S6v2\Model\Vendor;


use Training\S4v1\Model\ResourceModel\Vendor\CollectionFactory;
use Training\S4v1\Model\Vendor;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $contactCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contactCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        /** @var Vendor $vendor */
        foreach ($items as $vendor) {

            $this->loadedData[$vendor->getId()]['vendor'] = $vendor->getData();
        }


        return $this->loadedData;

    }
}