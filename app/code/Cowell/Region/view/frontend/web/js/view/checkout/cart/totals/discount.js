define(
    [
       'CoWell_BasicTraining/js/view/checkout/summary/discount-fee',
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
                    return this.getFormattedPrice(totals.getSegment('customer_discount').value);
                }
            }
        });
    }
);
