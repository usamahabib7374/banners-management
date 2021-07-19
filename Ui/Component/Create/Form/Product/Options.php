<?php

namespace MageDad\BannerManagement\Ui\Component\Create\Form\Product;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\CatalogInventory\Helper\Stock as StockFilter;
use Magento\Framework\App\RequestInterface;

/**
 * Options tree for "Products" field
 */
class Options implements OptionSourceInterface {

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var \Magento\CatalogInventory\Helper\Stock
     */
    protected $stockFilter;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $productTree;
    protected $_attributeSetCollection;

    /**
     * @param ProductCollectionFactory $productCollectionFactory
     * @param RequestInterface $request
     */
    public function __construct(
    ProductCollectionFactory $productCollectionFactory, RequestInterface $request, StockFilter $stockFilter, \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $attributeSetCollection
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->stockFilter = $stockFilter;
        $this->request = $request;
        $this->_attributeSetCollection = $attributeSetCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray() {
        return $this->getProductTree();
    }

    /**
     * Retrieve products tree
     *
     * @return array
     */
    protected function getProductTree() {
        if ($this->productTree === null) {
            $collection = $this->productCollectionFactory->create();
            $collection->addAttributeToSelect('*');
            $collection->addAttributeToFilter('status', \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
            $collection->addAttributeToFilter('attribute_set_id', $this->getAttrSetId('Products'));
            $this->stockFilter->addInStockFilterToCollection($collection);
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            foreach ($collection as $product) {
                if ($product->getTypeId() == 'virtual') {
                    continue;
                }
                $productId = $product->getEntityId();
                
                if (!isset($productById[$productId])) {
                    $productById[$productId] = [
                        'value' => $productId,
                    ];
                }
                $productById[$productId]['label'] = $product->getName();
                $this->productTree = $productById;
            }
        }
        return $this->productTree;
    }

    public function getAttrSetId($attrSetName) {
        $attributeSet = $this->_attributeSetCollection->create()->addFieldToSelect(
                        '*'
                )->addFieldToFilter(
                        'attribute_set_name', $attrSetName
                )->addFieldToFilter(
                'entity_type_id', 4
        );
        $attributeSetId = 0;
        foreach ($attributeSet as $attr):
            $attributeSetId = $attr->getAttributeSetId();
        endforeach;
        return $attributeSetId;
    }

}
