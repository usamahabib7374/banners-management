<?php


namespace MageDad\BannerManagement\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Model\StoreManagerInterface;
use MageDad\BannerManagement\Model\BannerFactory;
use MageDad\BannerManagement\Model\SliderFactory;
use MageDad\BannerManagement\Helper\AbstractData;

/**
 * Class Data
 *
 * @package MageDad\BannerManagement\Helper
 */
class Data extends AbstractData
{
    const CONFIG_MODULE_PATH = 'bannerslider';

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var HttpContext
     */
    protected $httpContext;

    /**
     * @var BannerFactory
     */
    public $bannerFactory;

    /**
     * @var SliderFactory
     */
    public $sliderFactory;

    /**
     * Data constructor.
     *
     * @param DateTime               $date
     * @param Context                $context
     * @param HttpContext            $httpContext
     * @param BannerFactory          $bannerFactory
     * @param SliderFactory          $sliderFactory
     * @param StoreManagerInterface  $storeManager
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        DateTime $date,
        Context $context,
        HttpContext $httpContext,
        BannerFactory $bannerFactory,
        SliderFactory $sliderFactory,
        StoreManagerInterface $storeManager,
        ObjectManagerInterface $objectManager
    ) {
        $this->date          = $date;
        $this->httpContext   = $httpContext;
        $this->bannerFactory = $bannerFactory;
        $this->sliderFactory = $sliderFactory;

        parent::__construct($context, $objectManager, $storeManager);
    }

    /**
     * @param null $slider
     *
     * @return false|string
     */
    public function getBannerOptions($slider = null)
    {
        if ($slider && $slider->getDesign() === "1") { //not use Config
            $config = $slider->getData();
        } else {
            $config = $this->getModuleConfig('bannerslider_design');
        }

        $defaultOpt    = $this->getDefaultConfig($config);
        $responsiveOpt = $this->getResponsiveConfig($slider);
        $effectOpt     = $this->getEffectConfig($slider);

        $sliderOptions = array_merge($defaultOpt, $responsiveOpt, $effectOpt);

        return self::jsonEncode($sliderOptions);
    }

    /**
     * @param null $slider
     *
     * @return false|string
     */
    public function getDeviceClass($slider = null)
    {
        $devicesArray=[];
        $devices=[];
        if ($slider) { //not use Config
            $devices = $slider->getData('visible_devices');
        }
        $devicesArray = explode(",",$devices);

        foreach($devicesArray as $device)
        {
            if($device==0)
            {
                $deviceClass[]="desktop";
            }else if($device==1)
            {
                $deviceClass[]="mobile";
            }      
        }

        return $deviceClass;
    }

    /**
     * @param $configs
     *
     * @return array
     */
    public function getDefaultConfig($configs)
    {
        $basicConfig = [];
        foreach ($configs as $key => $value) {
            if (in_array($key, ['autoWidth','autoHeight','loop','nav','dots','lazyLoad','autoplay','autoplayTimeout','autoplayHoverPause'])) {
                $basicConfig[$key] = (int)$value;
            }
        }

        return $basicConfig;
    }

    /**
     * @param null $slider
     *
     * @return array
     */
    public function getResponsiveConfig($slider = null)
    {
        if ($slider === "null") {
            $isResponsive = $this->getModuleConfig('bannerslider_design/responsive') == 1;
            try {
                $responsiveItems = $this->unserialize($this->getModuleConfig('bannerslider_design/item_slider'));
            } catch (\Exception $e) {
                $responsiveItems = [];
            }
        } else {
            $isResponsive = $slider->getIsResponsive();
            try {
                $responsiveItems = $this->unserialize($slider->getResponsiveItems());
            } catch (\Exception $e) {
                $responsiveItems = [];
            }
        }
        if (!$isResponsive || !$responsiveItems) {
            return ["items" => 1];
        }

        $result = [];
        foreach ($responsiveItems as $config) {
            $size          = $config['size'] ?: 0;
            $items         = $config['items'] ?: 0;
            $result[$size] = ["items" => $items];
        }

        return ['responsive' => $result];
    }

    /**
     * @param $slider
     *
     * @return array
     */
    public function getEffectConfig($slider)
    {
        if (!$slider) {
            return [];
        }

        return ['animateOut' => $slider->getEffect()];
    }

    /**
     * @param null $id
     *
     * @return \MageDad\BannerManagement\Model\ResourceModel\Banner\Collection
     */
    public function getBannerCollection($id = null)
    {
        $collection = $this->bannerFactory->create()->getCollection();

        $collection->join(
            ['banner_slider' => $collection->getTable('magedad_bannerslider_banner_slider')],
            'main_table.banner_id=banner_slider.banner_id AND banner_slider.slider_id=' . $id,
            ['position']
        );

        $collection->addOrder('position', 'ASC');

        return $collection;
    }

    /**
     * @return Collection
     */
    public function getActiveSliders($device = 0)
    {
        /**
 * @var Collection $collection
*/
        $collection = $this->sliderFactory->create()
            ->getCollection()
            ->addFieldToFilter('customer_group_ids', ['finset' => $this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_GROUP)])
            ->addFieldToFilter('status', 1)
            ->addOrder('priority');

        $collection->addFieldToFilter(
            ['store_ids', 'store_ids'],
            [
                ['finset' => $this->storeManager->getStore()->getId()],
                ['finset' => 0]
            ]
        );

        $collection->addFieldToFilter(
            ['from_date', 'from_date'],
            [
                ['null' => true],
                ['lteq' => $this->date->date()]
            ]
        );

        $collection->addFieldToFilter(
            ['to_date', 'to_date'],
            [
                ['null' => true],
                ['gteq' => $this->date->date()]
            ]
        );

        // $collection->addFieldToFilter('visible_devices', ['finset' => $device]);
        $collection->setPageSize(1);

        return $collection;
    }

    public function getSliderById($sliderId =1)
    {
        $sliderEnable = $this->getModuleConfig('general/enabled');
        /**
         * @var Collection $collection
         */
        $collection=[];

        if($sliderEnable)
        {
            $collection = $this->sliderFactory->create()
            ->getCollection()
            ->addFieldToFilter(
                'slider_id',
                ['eq' => $sliderId]
            )
            ->addFieldToFilter('status', 1)
            ->addOrder('priority')
            ->setPageSize(1);
        }

        return $collection;
    }

    public function getSliderByName($sliderName = 'DESKTOP')
    {
        /**
         * @var Collection $collection
         */
        $collection = $this->sliderFactory->create()
            ->getCollection()
            ->addFieldToFilter(
                'name',
                ['eq' => $sliderName]
            )
            ->addFieldToFilter('status', 1)
            ->addOrder('priority')
            ->setPageSize(1);

        return $collection;
    }
}
