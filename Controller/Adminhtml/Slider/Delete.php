<?php

namespace MageDad\BannerManagement\Controller\Adminhtml\Slider;

use MageDad\BannerManagement\Controller\Adminhtml\Slider;

/**
 * Class Delete
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml\Slider
 */
class Delete extends Slider {

    protected function _isAllowed() {
        return $this->_authorization->isAllowed('MageDad_BannerManagement::slider');
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            /**
             * @var \MageDad\BannerManagement\Model\Banner $banner
             */
            $this->sliderRepository
                    ->deleteById($this->getRequest()->getParam('slider_id'));

            $this->messageManager->addSuccess(__('The slider has been deleted.'));
        } catch (\Exception $e) {
            // display error message
            $this->messageManager->addErrorMessage($e->getMessage());
            // go back to edit form
            $resultRedirect->setPath('bannermanagement/slider/edit', ['slider_id' => $this->getRequest()->getParam('slider_id')]);

            return $resultRedirect;
        }

        $resultRedirect->setPath('bannermanagement/slider/');

        return $resultRedirect;
    }

}
