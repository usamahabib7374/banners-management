<?php

namespace MageDad\BannerManagement\Controller\Adminhtml\Slider;

use Magento\Backend\App\Action;

/**
 * Class NewAction
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml\Slider
 */
class NewAction extends Action {

    protected function _isAllowed() {
        return $this->_authorization->isAllowed('MageDad_BannerManagement::slider');
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute() {
        $this->_forward('edit');
    }

}
