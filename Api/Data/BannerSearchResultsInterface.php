<?php
/**
 * php version 7.2.17
 */
namespace MageDad\BannerManagement\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for banner search results.
 *
 * @api
 * @since 100.0.2
 */
interface BannerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get banner list.
     *
     * @return MageDad\BannerManagement\Api\Data\BannerInterface[]
     */
    public function getItems();

    /**
     * Set banner list.
     *
     * @param  MageDad\BannerManagement\Api\Data\BannerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
