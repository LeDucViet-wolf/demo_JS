<?php

namespace Demo\Catalog\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $days = [
            'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'
        ];
        if (version_compare($context->getVersion(), '1.0.4') < 0) {
            $sortOrder = 100;
            foreach ($days as $day) {
                $eavSetup->addAttribute(
                    Product::ENTITY,
                    $day . '_cutoff_at',
                    [
                        'type' => 'varchar',
                        'label' => ucfirst($day) . ' Cutoff At',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => $sortOrder++,
                        'global' => ScopedAttributeInterface::SCOPE_STORE,
                        'group' => 'Cutoff',
                    ]
                );
            }
        }
    }
}
