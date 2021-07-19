<?php


namespace MageDad\BannerManagement\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use MageDad\BannerManagement\Model\BannerRepository;
use MageDad\BannerManagement\Model\BannerFactory;
/**
 * Class Banner
 *
 * @package MageDad\BannerManagement\Controller\Adminhtml
 */
abstract class Banner extends Action
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Result redirect factory
     *
     * @var \Magento\Backend\Model\View\Result\RedirectFactory
     */

    /**
     * constructor
     *
     * @param Registry      $coreRegistry
     * @param Context       $context
     */
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
         BannerRepository $bannerRepository,
         BannerFactory $bannerFactory
         )
        {
            $this->coreRegistry = $coreRegistry;
            $this->bannerRepository = $bannerRepository;
            $this->bannerFactory  = $bannerFactory->create();
            parent::__construct($context);
        }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {

        return $resultPage;
    }
    /**
     * Init Banner
     *
     * @return \MageDad\BannerManagement\Model\Banner
     */
    protected function initBanner()
    {
        $bannerId = (int)$this->getRequest()->getParam('id');
        /**
         * @var \MageDad\BannerManagement\Model\Banner $banner
        */
        $banner = $this->bannerFactory;
        if ($bannerId) {
           $banner=$this->bannerRepository->getById($bannerId);
        }
        $this->coreRegistry->register('bannerslider_banner', $banner);

        return $banner;
    }

}
