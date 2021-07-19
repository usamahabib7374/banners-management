<?php
/**
 * php version 7.2.17
 */
namespace MageDad\BannerManagement\Model;

use MageDad\BannerManagement\Api\Data\SliderInterface;

class SliderBanners extends Slider
{

	const BANNERS = 'banners';

    public function getBanners()
    {
      return $this->getData(self::BANNERS);
    }

    public function setBanners($banners)
    {
        return $this->setData(self::BANNERS, $banners);
    }
}