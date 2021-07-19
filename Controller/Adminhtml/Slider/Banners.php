<?php


namespace MageDad\BannerManagement\Controller\Adminhtml\Slider;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\LayoutFactory;
use MageDad\BannerManagement\Controller\Adminhtml\Slider;
use MageDad\BannerManagement\Model\SliderRepository;
use MageDad\BannerManagement\Model\SliderFactory;

/**
 * Class Banners
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml\Slider
 */
class Banners extends Slider
{
    /**
     * Result layout factory
     *
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $resultLayoutFactory;

    /**
     * Banners constructor.
     *
     * @param LayoutFactory $resultLayoutFactory
     * @param SliderRepository $sliderRepository
     * @param Registry      $registry
     * @param Context       $context
     */
    public function __construct(
        LayoutFactory $resultLayoutFactory,
        SliderRepository $sliderRepository,
        SliderFactory $sliderFactory,
        Registry $registry,
        Context $context
    ) {
        $this->resultLayoutFactory = $resultLayoutFactory;

        parent::__construct($sliderRepository,$sliderFactory, $registry, $context);
    }
        protected function _isAllowed() {
        return $this->_authorization->isAllowed('MageDad_BannerManagement::slider');
    }

    /**
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $this->initSlider();
        $resultLayout = $this->resultLayoutFactory->create();
        /**
         * @var \MageDad\BannerManagement\Block\Adminhtml\Slider\Edit\Tab\Banner $bannersBlock
        */
        $bannersBlock = $resultLayout->getLayout()->getBlock('slider.edit.tab.banner');
        if ($bannersBlock) {
            $bannersBlock->setSliderBanners($this->getRequest()->getPost('slider_banners', null));
        }

        return $resultLayout;
    }
}
