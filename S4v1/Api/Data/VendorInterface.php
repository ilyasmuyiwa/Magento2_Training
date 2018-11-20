<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 10:08 PM
 */

namespace Training\S4v1\Api\Data;


use Magento\Framework\Api\ExtensibleDataInterface;

interface VendorInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return \Training\S4v1\Api\Data\VendorInterface
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getVendorName();

    /**
     * @param string $vendor_name
     * @return \Training\S4v1\Api\Data\VendorInterface
     */
    public function setVendorName($vendor_name);

    /**
     * @return string
     */
    public function getZip();

    /**
     * @param string $zip
     * @return \Training\S4v1\Api\Data\VendorInterface
     */
    public function setZip($zip);

    /**
     * @return int
     */
    public function getProductId();

    /**
     * @param string $product_id
     * @@return \Training\S4v1\Api\Data\VendorInterface
     */
    public function setProductId($product_id);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return \Training\S4v1\Api\Data\VendorInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @param string $updatedAt
     * @return \Training\S4v1\Api\Data\VendorInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * {@inheritdoc}
     *
     * @return \Training\S4v1\Api\Data\VendorExtensionInterface|null
     */
    public function getExtensionAttributes();


    /**
     * {@inheritdoc}
     *
     * @param \Training\S4v1\Api\Data\VendorExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Training\S4v1\Api\Data\VendorExtensionInterface $extensionAttributes);

}