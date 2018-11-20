<?php
namespace Training\S4v1\Api\Data;


/**
 * Interface for preorder Complete search results.
 * @api
 */
interface VendorResultInterface {
    /**
     * @return \Training\S4v1\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * @param \Training\S4v1\Api\Data\VendorInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}