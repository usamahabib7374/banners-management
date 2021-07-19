<?php


namespace MageDad\BannerManagement\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Effect
 *
 * @package MageDad\BannerManagement\Model\Config\Source
 */
class DesignOptions implements ArrayInterface
{

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => 0,
                'label' => __('Use Config')
            ],
            [
                'value' => 1,
                'label' => __('Yes')
            ]
        ];

        return $options;
    }
}
