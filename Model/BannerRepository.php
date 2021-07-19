<?php
/*
 * php version 7.2.17
 */
namespace MageDad\BannerManagement\Model;

use MageDad\BannerManagement\Api\BannerRepositoryInterface;
use MageDad\BannerManagement\Api\Data;
use MageDad\BannerManagement\Model\ResourceModel\Banner as ResourceBanner;
use MageDad\BannerManagement\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

/**
 * Class BannerRepository
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BannerRepository implements BannerRepositoryInterface
{
	/**
	 * @var ResourceBanner
	 */
	protected $resource;

	/**
	 * @var BannerFactory
	 */
	protected $bannerFactory;

	/**
	 * @var BannerCollectionFactory
	 */
	protected $bannerCollectionFactory;

	/**
	 * @var Data\BannerSearchResultsInterfaceFactory
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
	 * @var \MageDad\BannerManagement\Api\Data\BannerInterfaceFactory
	 */
	protected $dataBannerFactory;

	/**
	 * @var CollectionProcessorInterface
	 */
	private $collectionProcessor;

	/**
	 * @param ResourceBanner                           $resource
	 * @param BannerFactory                            $bannerFactory
	 * @param Data\BannerInterfaceFactory              $dataBannerFactory
	 * @param BannerCollectionFactory                  $bannerCollectionFactory
	 * @param Data\BannerSearchResultsInterfaceFactory $searchResultsFactory
	 * @param DataObjectHelper                        $dataObjectHelper
	 * @param DataObjectProcessor                     $dataObjectProcessor
	 */
	public function __construct(
		ResourceBanner $resource,
		BannerFactory $bannerFactory,
		\MageDad\BannerManagement\Api\Data\BannerInterfaceFactory $dataBannerFactory,
		BannerCollectionFactory $bannerCollectionFactory,
		Data\BannerSearchResultsInterfaceFactory $searchResultsFactory,
		DataObjectHelper $dataObjectHelper,
		DataObjectProcessor $dataObjectProcessor,
		CollectionProcessorInterface $collectionProcessor = null
	) {
		$this->resource = $resource;
		$this->bannerFactory = $bannerFactory;
		$this->bannerCollectionFactory = $bannerCollectionFactory;
		$this->searchResultsFactory = $searchResultsFactory;
		$this->dataObjectHelper = $dataObjectHelper;
		$this->dataBannerFactory = $dataBannerFactory;
		$this->dataObjectProcessor = $dataObjectProcessor;
		$this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
	}

	/**
	 * Save Banner data
	 *
	 * @param  \MageDad\BannerManagement\Api\Data\BannerInterface $banner
	 * @return banner
	 * @throws CouldNotSaveException
	 */
	public function save(Data\BannerInterface $banner)
    {
		try {
			$this->resource->save($banner);
		} catch (\Exception $exception) {
			throw new CouldNotSaveException(__($exception->getMessage()));
		}
		return $banner;
	}

	/**
	 * Load Banner data by given Banner Identity
	 *
	 * @param  string $bannerId
	 * @return Banner
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 */
	public function getById($bannerId)
    {
		$banner = $this->bannerFactory->create();
		$this->resource->load($banner, $bannerId);
		if (!$banner->getBannerId()) {
			throw new NoSuchEntityException(__('The Banner with the "%1" ID doesn\'t exist.', $bannerId));
		}
		return $banner;
	}

	/**
	 * Load Banner data collection by given search criteria
	 *
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 * @SuppressWarnings(PHPMD.NPathComplexity)
	 * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
	 * @return \MageDad\BannerManagement\Api\Data\BannerSearchResultsInterface
	 */
	public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
		/**
		 * @var \MageDad\BannerManagement\Model\ResourceModel\Banner\Collection $collection
		 */
		$collection = $this->bannerCollectionFactory->create();

		$this->collectionProcessor->process($criteria, $collection);
		/**
		 * @var Data\BannerSearchResultsInterface $searchResults
		 */
		$searchResults = $this->searchResultsFactory->create();
		$searchResults->setSearchCriteria($criteria);
		$searchResults->setItems($collection->getItems());
		$searchResults->setTotalCount($collection->getSize());
		
		return $searchResults;
	}

	/**
	 * Delete Banner
	 *
	 * @param  \MageDad\BannerManagement\Api\Data\BannerInterface $banner
	 * @return bool
	 * @throws CouldNotDeleteException
	 */
	public function delete(Data\BannerInterface $banner)
    {
		try {
			$this->resource->delete($banner);
		} catch (\Exception $exception) {
			throw new CouldNotDeleteException(__($exception->getMessage()));
		}
		return true;
	}

	/**
	 * Delete Banner by given Banner Identity
	 *
	 * @param  string $bannerId
	 * @return bool
	 * @throws CouldNotDeleteException
	 * @throws NoSuchEntityException
	 */
	public function deleteById($bannerId)
    {
		return $this->delete($this->getById($bannerId));
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
}
