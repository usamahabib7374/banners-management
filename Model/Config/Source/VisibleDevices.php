<?php


namespace MageDad\BannerManagement\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class VisibleDevices implements ArrayInterface
{
    const DEVICE_DESKTOP = '0';
    const DEVICE_MOBILE = '1';
    const DEVICE_MOBILE_APP = '2';

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $options = [
            [
                'label' => __('Desktop'),
                'value' => self::DEVICE_DESKTOP
            ],
            [
                'label' => __('Mobile'),
                'value' => self::DEVICE_MOBILE
            ],
            [
                'label' => __('Mobile App'),
                'value' => self::DEVICE_MOBILE_APP
            ]
        ];

        return $options;
    }
}
