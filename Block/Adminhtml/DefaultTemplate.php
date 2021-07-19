<?php
namespace MageDad\BannerManagement\Block\Adminhtml;
use Magento\Backend\Block\Template;

class DefaultTemplate extends Template
{

	CONST DEMO_1="demo1.png";
	CONST DEMO_2="demo2.png";
	CONST DEMO_3="demo3.png";
	CONST DEMO_4="demo4.jpg";
	CONST DEMO_5="demo5.jpg";

	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Framework\View\Asset\Repository $assetRepo
	)
    {
    	$this->assetRepo = $assetRepo;
        parent::__construct($context);
    }
    public function getImages()
    {
    	$image1=$this->assetRepo->getUrl('MageDad_BannerManagement::images/' . self::DEMO_1);
    	$image2=$this->assetRepo->getUrl('MageDad_BannerManagement::images/' . self::DEMO_2);
    	$image3=$this->assetRepo->getUrl('MageDad_BannerManagement::images/' . self::DEMO_3);
    	$image4=$this->assetRepo->getUrl('MageDad_BannerManagement::images/' . self::DEMO_4);
    	$image5=$this->assetRepo->getUrl('MageDad_BannerManagement::images/' . self::DEMO_5);

    	$imageArray=[$image1,$image2,$image3,$image4,$image5];

        return $imageArray;
    }

    public function getTemplateHtml($template)
    {
        if($template==1)
        {
        	$url="magedad/bannermanagement/banner/demo/".self::DEMO_1;
        }
        else if($template==2)
        {
        	$url="magedad/bannermanagement/banner/demo/".self::DEMO_2;
        }
        else if($template==3)
        {
        	$url="magedad/bannermanagement/banner/demo/".self::DEMO_3;
        }
        else if($template==4)
        {
        	$url="magedad/bannermanagement/banner/demo/".self::DEMO_4;
        }
        else if($template==5)
        {
        	$url="magedad/bannermanagement/banner/demo/".self::DEMO_5;
        }
    	
        $imgTmp = '<div class="item" style="background:url({{media url=&quot;'.$url.'&quot;}}) center center no-repeat;background-size:cover;"><div class="container" style="position:relative"><img src="{{media url=&quot;'.$url.'&quot;}}" alt="Demo Template"></div></div>';
            return $imgTmp;

     }

}