<?php
namespace Training\S1v2\Model\Sample;

use Magento\Framework\Config\SchemaLocatorInterface;
use Magento\Framework\Config\Dom\UrnResolver;

class SchemaLocator implements SchemaLocatorInterface
{
    /** @var UrnResolver */
    protected $urnResolver;

    public function __construct(UrnResolver $urnResolver)
    {
        $this->urnResolver = $urnResolver;
    }

    /**
     * Get path to merged config schema
     *
     * @return string
     */
    public function getSchema()
    {
        return $this->urnResolver->getRealPath('urn:training:module:Training_S1v2:/etc/sample.xsd');
    }

    /**
     * Get path to pre file validation schema
     *
     * @return string
     */
    public function getPerFileSchema()
    {
        return $this->urnResolver->getRealPath('urn:training:module:Training_S1v2:/etc/sample.xsd');
    }
}