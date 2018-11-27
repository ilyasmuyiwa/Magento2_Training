<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/22/18
 * Time: 6:59 AM
 */

namespace Training\S5v3\Setup;


use Magento\Catalog\Model\Category;
use Magento\Cms\Model\BlockFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /** @var EavSetupFactory */
    protected $eavSetupFactory;

    /** @var BlockFactory */
    protected $blockFactory;

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        BlockFactory $blockFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->blockFactory = $blockFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if(version_compare($context->getVersion(), '0.0.1') < 0) {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $eavSetup->addAttribute(Category::ENTITY, 'show_promotion_banner',[
                'type' => 'int',
                'input' => 'select',
                'label' => 'Enable Promotion Banner',
                'group' => 'Display Settings',
                'sort_order' => 20,
                'required' => false,
                'visible_on_front' => true,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL
            ]);
        }

        if(version_compare($context->getVersion(), '0.0.2') < 0) {
            $data = [
                'title' => 'Custom Block',
                'identifier' => 'custom_block',
                'content' => '<p style="color: #ff0619; font-weight: bold">Custom Text</p>',
                'is_active' => true

            ];

            $this->blockFactory->create()->setData($data)->save();
        }

        $setup->endSetup();
    }

}