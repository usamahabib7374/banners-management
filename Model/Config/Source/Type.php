<?php


namespace MageDad\BannerManagement\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Type
 *
 * @package MageDad\BannerManagement\Model\Config\Source
 */
class Type implements ArrayInterface
{
    const IMAGE   = '0';
    const CONTENT = '1';
    const VIDEO = '2';

    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::IMAGE,
                'label' => __('Image')
            ],
            [
                'value' => self::CONTENT,
                'label' => __('Advanced')
            ],
            [
                'value' => self::VIDEO,
                'label' => __('Video')
            ]
        ];

        return $options;
    }
}
