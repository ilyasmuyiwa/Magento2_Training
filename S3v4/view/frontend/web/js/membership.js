

define([
    'jquery',
    'Magento_Customer/js/customer-data'
    ],
    
    function ($, storage) {
        "use strict";

        var customer = storage.get('customer')();

        alert(customer);
        
        if (!$.isEmptyObject(customer)) {
            $('#membership').show();
            $('#membership select').val(customer.membership);

            $('#membership select').change(function () {

                var selected = $("#membership option:selected").val();
                customer.membership = selected;

                storage.set('customer', customer);
                
            });
        }
    });