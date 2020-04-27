<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Wallsandfloors\PM\Model\PM\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Status implements OptionSourceInterface
{
    /**
     * @var \Wallsandfloors\PM\Model\PM
     */
    protected $pm;

    /**
     * Constructor
     *
     * @param \Wallsandfloors\PM\Model\PM $pm
     */
    public function __construct(\Wallsandfloors\PM\Model\PM $pm)
    {
        $this->pm = $pm;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->pm->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
