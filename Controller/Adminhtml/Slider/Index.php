<?php

namespace MageDad\BannerManagement\Controller\Adminhtml\Slider;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml\Slider
 */
class Index extends Action {

    /**
     * Page result factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Page factory
     *
     * @var \Magento\Backend\Model\View\Result\Page
     */
    protected $resultPage;

    /**
     * constructor
     *
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Backend\App\Action\Context        $context
     */
    public function __construct(
    PageFactory $resultPageFactory, Context $context
    ) {
        $this->resultPageFactory = $resultPageFactory;

        parent::__construct($context);
    }

    protected function _isAllowed() {
        return $this->_authorization->isAllowed('MageDad_BannerManagement::slider');
    }

    /**
     * execute the action
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\View\Result\Page
     */
    public function execute() {
        $resultPage = $this->resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Manage Sliders')));

        return $resultPage;
    }

}
