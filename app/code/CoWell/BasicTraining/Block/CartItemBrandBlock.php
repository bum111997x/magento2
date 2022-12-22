<?php
/* File: app/code/Atwix/CatalogAttribute/Block/CartItemBrandBlock.php */
namespace CoWell\BasicTraining\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use Magento\Catalog\Model\Product;
use Magento\Checkout\Block\Cart\Additional\Info as AdditionalBlockInfo;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template as ViewTemplate;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class CartItemBrandBlock
 */
class CartItemBrandBlock extends ViewTemplate
{
    /**
     * Product
     *
     * @var ProductInterface|null
     */
    protected $product = null;
    /**
     * Product Factory
     *
     * @var ProductInterfaceFactory
     */
    protected $productFactory;
    /**
     * CartItemBrandBlock constructor
     *
     * @param Context $context
     * @param ProductInterfaceFactory $productFactory
     */
    protected $quote;

    public function __construct(
        Context $context,
        ProductInterfaceFactory $productFactory,
        \Magento\Quote\Model\Quote $quote,
        Session $session
    ) {
        parent::__construct($context);
        $this->productFactory = $productFactory;
        $this->quote = $quote;
    }
    /**
     * Get Product Brand Text
     *
     * @return string
     */
    public function getProductShippingFee(): string
    {
        $product = $this->getProduct();
        /** @var Product $product */
        $productShip = (string) $product->getData('shipping_fee');
        $products = $this->quote->getItems();
        return $productShip;
    }
    /**
     * Get product from quote item
     *
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        if ($this->product instanceof ProductInterface) {
            return $this->product;
        }
        try {
            $layout = $this->getLayout();
        } catch (LocalizedException $e) {
            $this->product = $this->productFactory->create();
            return $this->product;
        }
        /** @var AdditionalBlockInfo $block */
        $block = $layout->getBlock('additional.product.info');
        if ($block instanceof AdditionalBlockInfo) {
            $item = $block->getItem();
            $this->product = $item->getProduct();
        }
        return $this->product;
    }
}
