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
interface BannerInterface {

    /**
     * #@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const BANNER_ID = 'banner_id';
    const NAME = 'name';
    const NAME_AR = 'name_ar';
    const STATUS = 'status';
    const TYPE = 'type';
    const CONTENT = 'content';
    const IMAGE = 'image';
    const URL_BANNER = 'url_banner';
    const TITLE = 'title';
    const TITLE_AR = 'title_ar';
    const NEWTAB = 'newtab';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const PRODUCT_ID = 'product_id';

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getBannerId();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $id
     * @return $this
     */
    public function setBannerId($id);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getStatus();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getName();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getProductId();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $product_id
     * @return $this
     */
    public function setProductId($product_id);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getType();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $type
     * @return $this
     */
    public function setType($type);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getContent();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $content
     * @return $this
     */
    public function setContent($content);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getImage();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $image
     * @return $this
     */
    public function setImage(array $image = null);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getUrlBanner();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $url
     * @return $this
     */
    public function setUrlBanner($url);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getTitle();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getNewTab();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $newTab
     * @return $this
     */
    public function setNewTab($newTab);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getCreatedAt();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $newTab
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getUpdatedAt();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $newTab
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $newTab
     * @return $this
     */
    public function getSlideType();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $newTab
     * @return $this
     */
    public function getImageUrl();

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getNameAr();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $name_ar
     * @return $this
     */
    public function setNameAr($name_ar);

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerInterface
     */
    public function getTitleAr();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface $title_ar
     * @return $this
     */
    public function setTitleAr($title_ar);
}
