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
interface SliderBannersInterface extends SliderInterface
{

    /**
     * @return MageDad\BannerManagement\Api\Data\BannerSearchResultsInterface
     */
    public function getBanners();

    /**
     * @param  MageDad\BannerManagement\Api\Data\BannerSearchResultsInterface $banners
     * @return $this
     */
    public function setBanners($banners);
}