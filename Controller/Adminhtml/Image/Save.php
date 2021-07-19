<?php

namespace MageDad\BannerManagement\Controller\Adminhtml\Image;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Upload
 */

class Save extends \Magento\Backend\App\Action
{
    /**
     * Image uploader
     *
     * @var \MageDad\BannerManagement\Model\Image\ImageUploader
     */
    protected $imageUploader;

    /**
     * Upload constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \MageDad\BannerManagement\Model\Image\ImageUploader $imageUploader
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \MageDad\BannerManagement\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $imageId = $this->_request->getParam('param_name', 'image');

        try {
            $result = $this->imageUploader->saveFileToTmpDir($imageId);
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
