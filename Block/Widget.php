<?php
namespace MageDad\BannerManagement\Block;
use Magento\Widget\Block\BlockInterface;
use MageDad\BannerManagement\Block\Slider;
/**
 * Class Widget
 * @packageMageDad\BannerManagement\Block
 */

class Widget extends Slider implements BlockInterface
{
    /**
     * @return array|bool|\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    protected $_template = "widget/bannerslider.phtml";
     /**
     * @return array|bool|\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getBannerCollection()
    {
        $sliderId = $this->getData('slider_id');

        if (!$this->helperData->isEnabled() || !$sliderId) {
            return false;
        }

        $sliderCollection = $this->helperData->getActiveSliders();
        $slider           = $sliderCollection->addFieldToFilter('slider_id', $sliderId)->getFirstItem();
        $this->setSliderId($slider->getSliderId());
        $this->setSlider($slider);

        return parent::getBannerCollection();
    }
}