define(
    [
        'Cowell_ProductShippingMethod/js/view/checkout/summary/shipping_fee',
        'Magento_Checkout/js/model/totals'
    ],
    function (Component, totals) {
        'use strict';
        return Component.extend({
            /**
             * @override
             */
            isDisplayed: function () {
                return true;
            },
            getDiscountTotal: function () {
                if (this.totals()) {
                    return this.getFormattedPrice(totals.getSegment('payment_fee').value);
                }
            }
        });
    }
);
