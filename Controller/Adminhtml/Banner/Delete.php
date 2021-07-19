<?php


namespace MageDad\BannerManagement\Controller\Adminhtml\Banner;

use MageDad\BannerManagement\Controller\Adminhtml\Banner;

/**
 * Class Delete
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml\Banner
 */
class Delete extends Banner
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $bannerId=$this->getRequest()->getParam('id');
        try {
            $this->bannerRepository->deleteById($bannerId);
            $this->messageManager->addSuccess(__('The Banner has been deleted.'));
        } catch (\Exception $e) {
            // display error message
            $this->messageManager->addErrorMessage($e->getMessage());
            // go back to edit form
            $resultRedirect->setPath('bannermanagement/*/edit', ['id' => $bannerId]);

            return $resultRedirect;
        }

        $resultRedirect->setPath('bannermanagement/*/');

        return $resultRedirect;
    }
}
