<?php

namespace CoWell\BasicTraining\Plugin;

use Magento\Checkout\Model\Session as CheckoutSession;

class Defaultconfigprovider
{
    /**
     * @var CheckoutSession
     */

    protected $checkoutSession;


    /**
     * Constructor
     *
     * @param CheckoutSession $checkoutSession
     */

    public function __construct(
        CheckoutSession $checkoutSession,
    ) {

        $this->checkoutSession = $checkoutSession;
    }


    public function afterGetConfig(
        \Magento\Checkout\Model\DefaultConfigProvider $subject,
        array                                         $result
    ) {

        $array = [];
        $items = $result['totalsData']['items'];

        foreach ($items as $item) {
            $quoteItem = $this->checkoutSession->getQuote()->getItemById($item['item_id']);

            $array[$item['item_id']] =
                $quoteItem->getProduct()->getData('shipping_fee');
        }
        $result['shipping_fee'] = $array;
        return $result;
    }
}
