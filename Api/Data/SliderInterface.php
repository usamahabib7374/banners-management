<?php
/**
 * php version 7.2.17
 */
namespace MageDad\BannerManagement\Api\Data;

/**
 * Banner interface.
 *
 * @api
 * @since 100.0.2
 */
interface SliderInterface
{
    /**
     * #@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const SLIDER_ID = 'slider_id';
    const NAME = 'name';
    const STATUS = 'status';
    const LOCATION = 'location';
    const STOREIDS = 'store_ids';
    const CUSTOMERGROUPIDS = 'customer_group_ids';
    const PRIORITY = 'priority';
    const EFFECT = 'effect';
    const AUTOWIDTH = 'autowidth';
    const AUTOHEIGHT = 'autoheight';
    const DESIGN = 'design';
    const LOOP = 'loop';
    const LAZYLOAD = 'lazyload';
    const AUTOPLAY = 'autoplay';
    const AUTOPLAYTIMEOUT = 'autoplaytimeout';
    const NAV = 'nav';
    const DOTS = 'dots';
    const ISRESPONSIVE = 'is_responsive';
    const RESPONSIVEITEMS = 'responsive_items';
    const FROMDATE = 'from_date';
    const TODATE = 'to_date';
    const CREATEDAT = 'created_at';
    const UPDATEDAT = 'updated_at';
    const VISIBLEDEVICES = 'visible_devices';
    const AUTOPLAYHOVERPAUSE = 'autoplayhoverpause';

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getSliderId();
    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $id
     * @return $this
     */
    public function setSliderId($id);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getStatus();
    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getName();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getLocation();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $location
     * @return $this
     */
    public function setLocation($location);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getStoreids();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $storeids
     * @return $this
     */
    public function setStoreids($storeids);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getCustomerGroupIds();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $customerGroupIds
     * @return $this
     */
    public function setCustomerGroupIds($customerGroupIds);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getPriority();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $priority
     * @return $this
     */
    public function setPriority($priority);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getEffect();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $effect
     * @return $this
     */
    public function setEffect($title);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getAutoWidth();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $autoWidth
     * @return $this
     */
    public function setAutoWidth($autoWidth);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getAutoHeight();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $autoHeight
     * @return $this
     */
    public function setAutoHeight($autoHeight);

     /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getDesign();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $design
     * @return $this
     */
    public function setDesign($design);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getLoop();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $loop
     * @return $this
     */
    public function setLoop($loop);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getLazyload();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $lazyload
     * @return $this
     */
    public function setLazyload($lazyload);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getAutoplay();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $autoplay
     * @return $this
     */
    public function setAutoplay($autoplay);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getAutoplaytimeout();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $autoplay
     * @return $this
     */
    public function setAutoplaytimeout($autoplaytimeout);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getNav();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $nav
     * @return $this
     */
    public function setNav($nav);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getDots();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $dots
     * @return $this
     */
    public function setDots($dots);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getIsResponsive();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $isResponsive
     * @return $this
     */
    public function setIsResponsive($isResponsive);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getResponsiveItems();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $responsiveItems
     * @return $this
     */
    public function setResponsiveItems($responsiveItems);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getFromDate();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $formDate
     * @return $this
     */
    public function setFromDate($formDate);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getToDate();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $toDate
     * @return $this
     */
    public function setToDate($toDate);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getCreatedAt();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $toDate
     * @return $this
     */
    public function setCreatedAt($createdAt);

     /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getUpdatedAt();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getVisibleDevices();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $visibleDevices
     * @return $this
     */
    public function setVisibleDevices($visibleDevices);

    /**
     * @return MageDad\BannerManagement\Api\Data\SliderInterface
     */
    public function getAutoplayhoverpause();

    /**
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface $autoplayhoverpause
     * @return $this
     */
    public function setAutoplayhoverpause($autoplayhoverpause);
}
