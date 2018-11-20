<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 10:08 PM
 */

namespace Training\S4v1\Api\Data;


use Magento\Framework\Api\ExtensibleDataInterface;

interface TypeInterface extends ExtensibleDataInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @param $type
     * @return mixed
     */
    public function setType($type);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $createdAt
     * @return mixed
     */
    public function setCreatedAt($createdAt);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @param $updatedAt
     * @return mixed
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Retrieve existing existing extension attributes
     * @return \Training\S4v1\Api\Data\TypeExtensionInterface\null
     */
    public function getExtensionAttributes();

    /**
     * @param TypeExtensionInterface $extensionAttributes
     * @return Type
     */
    public function setExtensionAttributes(\Training\S4v1\Api\Data\TypeExtensionInterface $extensionAttributes);


}