<?php


namespace MageDad\BannerManagement\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use MageDad\BannerManagement\Model\ResourceModel\Slider\CollectionFactory;

/**
 * Class Sliders
 * @package MageDad\BannerManagement\Model\Config\Source
 */
class Sliders implements ArrayInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Sliders constructor.
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $value => $label) {
            $options[] = [
                'value' => $value,
                'label' => $label
            ];
        }

        return $options;
    }

    /**
     * @return array
     */
    protected function toArray()
    {
        $options = [];
        $rules =$this->collectionFactory->create()->addFieldToFilter('status', ['eq' => "1"]);
        foreach ($rules as $rule) {
            $options[$rule->getId()] = $rule->getName();
        }

        return $options;
    }
}
