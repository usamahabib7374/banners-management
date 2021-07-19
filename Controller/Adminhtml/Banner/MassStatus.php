<?php


namespace MageDad\BannerManagement\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use MageDad\BannerManagement\Model\ResourceModel\Banner\CollectionFactory;

/**
 * Class MassStatus
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml\Banner
 */
class MassStatus extends Action
{
    /**
     * Mass Action Filter
     *
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    public $filter;

    /**
     * Collection Factory
     *
     * @var \MageDad\BannerManagement\Model\ResourceModel\Banner\CollectionFactory
     */
    public $collectionFactory;

    /**
     * MassStatus constructor.
     *
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;

        parent::__construct($context);
    }

    /**
     * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection    = $this->filter->getCollection($this->collectionFactory->create());
        $status        = (int)$this->getRequest()->getParam('status');
        $bannerUpdated = 0;
        foreach ($collection as $banner) {
            try {
                $banner->setStatus($status);
                $banner->save();

                $bannerUpdated++;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while updating status for %1.', $banner->getName()));
            }
        }

        if ($bannerUpdated) {
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been updated.', $bannerUpdated));
        }

        /**
		 * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect
		*/
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
