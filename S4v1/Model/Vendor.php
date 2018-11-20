<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 11:08 PM
 */

namespace Training\S4v1\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Training\S4v1\Api\Data\VendorInterface;


class Vendor extends AbstractExtensibleModel implements VendorInterface
{
    const ID = "vendor_id";
    const VENDOR_NAME = "vendor_name";
    const ZIP = "zip";
    const PRODUCT_ID = "product_id";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = "updated_at";

    protected function _construct()
    {
        $this->_init(\Training\S4v1\Model\ResourceModel\Vendor::class);
    }

    protected $_cacheTag = 'vendor';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'vendor';


    protected $_idFieldName = self::ID; // parent value is 'id'

    public function getId()
    {
      return $this->_getData(self::ID);

    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    public function getVendorName()
    {
        return $this->_getData(self::VENDOR_NAME);

    }

    /**
     * @param $vendor_name
     * @return VendorInterface|Vendor
     */
    public function setVendorName($vendor_name)
    {
        return $this->setData(self::VENDOR_NAME, $vendor_name);
    }

    public function getZip()
    {
        return $this->_getData(self::ZIP);

    }

    public function setZip($zip)
    {
        return $this->setData(self::ZIP, $zip);
    }

    public function getProductId()
    {
        return $this->_getData(self::PRODUCT_ID);

    }

    public function setProductId($product_id)
    {
        return $this->setData(self::PRODUCT_ID, $product_id);
    }

    public function getCreatedAt()
    {
        return $this->_getData(self::CREATED_AT);

    }

    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    public function getUpdatedAt()
    {
        return $this->_getData(self::UPDATED_AT);

    }

    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     * @param \Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Training\S4v1\Api\Data\VendorExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

}