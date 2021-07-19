<?php
/**
 * php version 7.2.17
 */
namespace MageDad\BannerManagement\Api;

/**
 * Banner crud interface.
 *
 * @api
 * @since 100.0.2
 */
interface BannerRepositoryInterface
{
    /**
     * Save banner.
     *
     * @param  \MageDad\BannerManagement\Api\Data\BannerInterface $banner
     * @return \MageDad\BannerManagement\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\BannerInterface $banner);

    /**
     * Retrieve banner.
     *
     * @param  int $bannerId
     * @return \MageDad\BannerManagement\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($bannerId);

    /**
     * Retrieve banners matching the specified criteria.
     *
     * @param  \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \MageDad\BannerManagement\Api\Data\BlockSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete banner.
     *
     * @param  \MageDad\BannerManagement\Api\Data\BannerInterface $banner
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\BannerInterface $banner);

    /**
     * Delete banner by ID.
     *
     * @param  int $bannerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($bannerId);
}
