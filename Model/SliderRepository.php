<?php
/*
 * php version 7.2.17
 */
namespace MageDad\BannerManagement\Model;

use MageDad\BannerManagement\Api\SliderRepositoryInterface;
use MageDad\BannerManagement\Api\Data;
use MageDad\BannerManagement\Model\ResourceModel\Slider as ResourceSlider;
use MageDad\BannerManagement\Model\ResourceModel\Slider\CollectionFactory as SliderCollectionFactory;
use MageDad\BannerManagement\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use MageDad\BannerManagement\Api\BannerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use MageDad\BannerManagement\Model\ResourceModel\SliderFactory as ResourceSliderFactory;
/**
 * Class SliderRepository
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SliderRepository implements SliderRepositoryInterface
{
	/**
	 * @var ResourceSlider
	 */
	protected $resource;

	/**
	 * @var SliderFactory
	 */
	protected $sliderFactory;

	/**
	 * @var SliderCollectionFactory
	 */
	protected $sliderCollectionFactory;

	/**
	 * @var Data\SliderSearchResultsInterfaceFactory
	 */
	protected $searchResultsFactory;

	/**
	 * @var DataObjectHelper
	 */
	protected $dataObjectHelper;

	/**
	 * @var DataObjectProcessor
	 */
	protected $dataObjectProcessor;

	/**
	 * @var \MageDad\BannerManagement\Api\Data\SliderInterfaceFactory
	 */
	protected $dataSliderFactory;

	/**
	 * @var CollectionProcessorInterface
	 */
	private $collectionProcessor;

	/**
	 * @param ResourceSlider                           $resource
	 * @param SliderFactory                            $sliderFactory
	 * @param Data\SliderInterfaceFactory              $dataSliderFactory
	 * @param SliderCollectionFactory                  $sliderCollectionFactory
	 * @param Data\SliderSearchResultsInterfaceFactory $searchResultsFactory
	 * @param DataObjectHelper                        $dataObjectHelper
	 * @param DataObjectProcessor                     $dataObjectProcessor
	 */
	public function __construct(
		ResourceSlider $resource,
		SliderFactory $sliderFactory,
		\MageDad\BannerManagement\Api\Data\SliderInterfaceFactory $dataSliderFactory,
		SliderCollectionFactory $sliderCollectionFactory,
		Data\SliderSearchResultsInterfaceFactory $searchResultsFactory,
		DataObjectHelper $dataObjectHelper,
		DataObjectProcessor $dataObjectProcessor,
		CollectionProcessorInterface $collectionProcessor = null,
		SliderBannersFactory $sliderBannersFactory,
		BannerRepositoryInterface $bannerRepositoryInterface,
		SearchCriteriaBuilder $searchCriteriaBuilder,
		BannerCollectionFactory $bannerCollectionFactory,
		ResourceSliderFactory $resourceSliderFactory
	) {
		$this->resource = $resource;
		$this->sliderFactory = $sliderFactory;
		$this->sliderBannersFactory = $sliderBannersFactory;
		$this->sliderCollectionFactory = $sliderCollectionFactory;
		$this->searchResultsFactory = $searchResultsFactory;
		$this->dataObjectHelper = $dataObjectHelper;
		$this->dataSliderFactory = $dataSliderFactory;
		$this->dataObjectProcessor = $dataObjectProcessor;
		$this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
		$this->bannerRepositoryInterface = $bannerRepositoryInterface;
		$this->searchCriteriaBuilder = $searchCriteriaBuilder;
		$this->bannerCollectionFactory = $bannerCollectionFactory;
		$this->resourceSliderFactory = $resourceSliderFactory->create();
	}

	/**
	 * Save Slider data
	 *
	 * @param  \MageDad\BannerManagement\Api\Data\SliderInterface $slider
	 * @return banner
	 * @throws CouldNotSaveException
	 */
	public function save(Data\SliderInterface $slider)
    {
		try {
			$this->resource->save($slider);
		} catch (\Exception $exception) {
			throw new CouldNotSaveException(__($exception->getMessage()));
		}
		return $slider;
	}

	/**
	 * Load Slider data by given Slider Identity
	 *
	 * @param  string $sliderId
	 * @return Slider
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 */
	public function getById($sliderId)
    {
		$slider = $this->sliderFactory->create();
		$this->resource->load($slider, $sliderId);
		if (!$slider->getSliderId()) {
			throw new NoSuchEntityException(__('The Slider with the "%1" ID doesn\'t exist.', $sliderId));
		}
		return $slider;
	}

	/**
	 * Load Slider data collection by given search criteria
	 *
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 * @SuppressWarnings(PHPMD.NPathComplexity)
	 * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
	 * @return \MageDad\BannerManagement\Api\Data\SliderSearchResultsInterface
	 */
	public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
		/**
		 * @var \MageDad\BannerManagement\Model\ResourceModel\Slider\Collection $collection
		 */
		$collection = $this->sliderCollectionFactory->create();

		$this->collectionProcessor->process($criteria, $collection);
		/**
		 * @var Data\SliderSearchResultsInterface $searchResults
		 */
		$searchResults = $this->searchResultsFactory->create();
		$searchResults->setSearchCriteria($criteria);
		$searchResults->setItems($collection->getItems());
		$searchResults->setTotalCount($collection->getSize());
		return $searchResults;
	}

	/**
	 * Delete Slider
	 *
	 * @param  \MageDad\BannerManagement\Api\Data\SliderInterface $slider
	 * @return bool
	 * @throws CouldNotDeleteException
	 */
	public function delete(Data\SliderInterface $slider)
    {
		try {
			$this->resource->delete($slider);
		} catch (\Exception $exception) {
			throw new CouldNotDeleteException(__($exception->getMessage()));
		}
		return true;
	}

	/**
	 * Delete Slider by given Slider Identity
	 *
	 * @param  string $sliderId
	 * @return bool
	 * @throws CouldNotDeleteException
	 * @throws NoSuchEntityException
	 */
	public function deleteById($sliderId)
    {
		return $this->delete($this->getById($sliderId));
	}

	/**
	 * Retrieve collection processor
	 *
	 * @deprecated 102.0.0
	 * @return     CollectionProcessorInterface
	 */
	private function getCollectionProcessor()
    {
		if (!$this->collectionProcessor) {
			$this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
				\Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface::class
			);
		}
		return $this->collectionProcessor;
	}

	public function getSliderBanners()
	{
		$collection = $this->sliderCollectionFactory->create();
		$collection->addFieldToFilter('visible_devices', \MageDad\BannerManagement\Model\Config\Source\VisibleDevices::DEVICE_MOBILE_APP);

		if ($collection->getSize() > 0) {
			$slider = $collection->getFirstItem();
		} else {
			return null;
		}

		$sliderBannerData = $this->resourceSliderFactory->getBannersSliderID($slider);

		$searchCriteria = $this->searchCriteriaBuilder->addFilter(
			  'banner_id',
			  $sliderBannerData,
			  'in'
			)->create();
		$banners = $this->bannerRepositoryInterface->getList($searchCriteria);
		$slider->setBanners($banners);
		return $slider;
	}
}
