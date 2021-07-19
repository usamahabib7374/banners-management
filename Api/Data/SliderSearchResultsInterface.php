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
interface SliderSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get banner list.
     *
     * @return MageDad\BannerManagement\Api\Data\SliderInterface[]
     */
    public function getItems();

    /**
     * Set banner list.
     *
     * @param  MageDad\BannerManagement\Api\Data\SliderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
