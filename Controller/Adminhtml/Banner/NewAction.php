<?php


namespace MageDad\BannerManagement\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;

/**
 * Class NewAction
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml\Banner
 */
class NewAction extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
