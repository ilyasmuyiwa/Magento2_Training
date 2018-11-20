<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 11:08 PM
 */

namespace Training\S4v1\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Training\S4v1\Api\Data\TypeInterface;


class Type extends AbstractExtensibleModel implements TypeInterface
{
    const ID = "vendor_type_id";
    const VENDOR_TYPE = "type";
    const VENDOR_ID = "vendor_id";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = "updated_at";

    protected function _construct()
    {
        $this->_init('\Training\S4v1\Model\ResourceModel\Type');
    }

    protected $_cacheTag = 'vendor_type';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'vendor_type';

    public function getId()
    {
        return $this->_getData(self::ID);

    }

    public function setId($id)
    {
        return $this->setData(self::ID);
    }

    public function getType()
    {
        return $this->_getData(self::VENDOR_TYPE);

    }

    public function setType($type)
    {
        return $this->setData(self::VENDOR_TYPE);
    }

    public function getCreatedAt()
    {
        return $this->_getData(self::CREATED_AT);

    }

    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->_getData(self::UPDATED_AT);

    }

    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT);
    }

    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    public function setExtensionAttributes(\Training\S4v1\Api\Data\TypeExtensionInterface $extensionAttributes)
    {
      return $this->_setExtensionAttributes($extensionAttributes);
    }

}