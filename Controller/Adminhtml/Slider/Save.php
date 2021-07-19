<?php

namespace MageDad\BannerManagement\Controller\Adminhtml\Slider;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Helper\Js;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use MageDad\BannerManagement\Controller\Adminhtml\Slider;
use MageDad\BannerManagement\Model\SliderRepository;
use MageDad\BannerManagement\Model\SliderFactory;

/**
 * Class Save
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml\Slider
 */
class Save extends Slider {

    /**
     * JS helper
     *
     * @var \Magento\Backend\Helper\Js
     */
    protected $jsHelper;

    /**
     * Date filter
     *
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $dateFilter;

    /**
     * Save constructor.
     *
     * @param Js            $jsHelper
     * @param SliderRepository $sliderRepository
     * @param Registry      $registry
     * @param Context       $context
     * @param Date          $dateFilter
     */
    public function __construct(
    Js $jsHelper, SliderRepository $sliderRepository, SliderFactory $sliderFactory, Registry $registry, Context $context, Date $dateFilter
    ) {
        $this->jsHelper = $jsHelper;
        $this->dateFilter = $dateFilter;

        parent::__construct($sliderRepository, $sliderFactory, $registry, $context);
    }

    protected function _isAllowed() {
        return $this->_authorization->isAllowed('MageDad_BannerManagement::slider');
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data = $this->getRequest()->getPostValue()) {
            $data = $this->_filterData($data);

            $slider = $this->sliderFactory;
            $sliderId = (int) $this->getRequest()->getParam('slider_id');

            if ($sliderId) {
                $slider->load($sliderId);
            }
            $bannersData = isset($data['bannermanagement_banner_slider_listing']) ? $data['bannermanagement_banner_slider_listing'] : [];
            $resultData = [];

            if (!empty($bannersData)) {
                foreach ($bannersData as $key => $value) {

                    $resultData[] = $value['banner_id'];
                }
                $slider->setBannersData($resultData);
            }
            $slider->setName($data['name']);
            $slider->setPriority($data['priority']);
            $slider->setResponsiveItems($data['responsive_items']);
            $slider->setStatus($data['status']);
            $slider->setEffect($data['effect']);
            $slider->setIsResponsive($data['is_responsive']);
            $slider->setAutoWidth($data['autoWidth']);
            $slider->setAutoHeight($data['autoHeight']);
            $slider->setLoop($data['loop']);
            $slider->setNav($data['nav']);
            $slider->setDots($data['dots']);
            $slider->setLazyLoad($data['lazyLoad']);
            $slider->setAutoplay($data['autoplay']);
            $slider->setAutoplaytimeout($data['autoplayTimeout']);
            $slider->setAutoplayhoverpause($data['autoplayHoverPause']);
            $slider->setDesign($data['design']);
            $slider->setStoreids($data['store_ids']);
            $slider->setCustomerGroupIds($data['customer_group_ids']);
            $slider->setVisibleDevices($data['visible_devices']);
            $slider->setFromDate($data['from_date']);
            $slider->setToDate($data['to_date']);

            try {
                $slider->save();
                $this->messageManager->addSuccess(__('The Slider has been saved.'));
                $this->_session->setMageDadBannerSliderSliderData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                            'bannermanagement/*/edit', [
                        'id' => $slider->getId(),
                        '_current' => true
                            ]
                    );

                    return $resultRedirect;
                }
                $resultRedirect->setPath('bannermanagement/*/');

                return $resultRedirect;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __($e->getMessage()));
            }

            $this->_getSession()->setMageDadBannerSliderSliderData($data);
            $resultRedirect->setPath(
                    'bannermanagement/*/edit', [
                'id' => $slider->getId(),
                '_current' => true
                    ]
            );

            return $resultRedirect;
        }

        $resultRedirect->setPath('bannermanagement/*/');

        return $resultRedirect;
    }

    /**
     * filter values
     *
     * @param array $data
     *
     * @return array
     */
    protected function _filterData($data) {
        $inputFilter = new \Zend_Filter_Input(['from_date' => $this->dateFilter,], [], $data);
        $data = $inputFilter->getUnescaped();

        // if (isset($data['responsive_items'])) {
        //     unset($data['responsive_items']['__empty']);
        // }
        // if ($banners = $this->getRequest()->getParam('banners')) {
        //     $data['banner_ids'] = $banners;
        // }

        return $data;
    }

}
