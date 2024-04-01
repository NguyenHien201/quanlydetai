(function($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    HT.select2 = () => {
        $('.setupSelect2').select2();
    }

    HT.changeStatus = () => {
        if($('.status').length) {
            $(document).on('change', '.status', function(e) {
                let _this = $(this);
                let option = {
                    'value' : _this.val(),
                    'modelId' : _this.attr('data-modelId'),
                    'model' : _this.attr('data-model'),
                    'field' : _this.attr('data-field'),
                    '_token' : _token,
                }
                
                $.ajax({
                    url: '/ajax/dashboard/changeStatus',
                    type: 'POST',
                    data: option,
                    dataType: 'json',
                    success: function(res) {
                        console.log(res)
        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                     console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    }
                });
            });
        }
    }

    HT.changerStatusAll = () => {
        if($('.changeAllStatus').length) {
            $(document).on('click', '.changeAllStatus', function(e) {
                let _this = $(this);
                let id = [];
                $('.checkBoxItem').each(function() {
                    let checkbox = $(this);
                    if(checkbox.prop('checked')) {
                        id.push(checkbox.val());
                    }
                })

                let option = {
                    'value' : _this.attr('data-value'),
                    'model' : _this.attr('data-model'),
                    'field' : _this.attr('data-field'),
                    'id' : id,
                    '_token' : _token,
                }

                $.ajax({
                    url: '/ajax/dashboard/changeStatusAll',
                    type: 'POST',
                    data: option,
                    dataType: 'json',
                    success: function(res) {
                        if(res.flag == true) {
                            for(let i = 0; i < id.length; i++) {
                                if(option.value == 2) {
                                    $('.checkBoxSwitch-' + id[i]).prop('checked', true);
                                } else if(option.value == 1) {
                                    $('.checkBoxSwitch-' + id[i]).prop('checked', false);
                                }
                            }
                        }
        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                     console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    }
                });

                e.preventDefault();
            })
        }
    }

    HT.checkAll = () => {
        if($('#checkAll').length) {
            $(document).on('click', '#checkAll', function() {
                
                let $isChecked = $(this).prop('checked');
                $('.checkBoxItem').prop('checked', $isChecked);
                $('.checkBoxItem').each(function() {
                    let _this = $(this);
                    HT.changeBackground(_this);
                })
            })
        }
    }

    HT.checkItem = () => {
        if($('.checkBoxItem').length) {
            $(document).on('click', '.checkBoxItem', function() {
                let _this = $(this);
                HT.changeBackground(_this);
                HT.allChecked();
            })
        }
    }

    HT.changeBackground = (object) => {
        let $isChecked = object.prop('checked');
        if($isChecked) {
            object.closest('tr').addClass('active_bg');
        }
        else {
            object.closest('tr').removeClass('active_bg');
        }
    }

    HT.allChecked = () => {
        let allChecked = $('.checkBoxItem:checked').length === $('.checkBoxItem').length;
        $('#checkAll').prop('checked', allChecked);
    }

    HT.changeCreateCustomerModal = () => {
        $('#formCreateCustomer').submit(function(event) {
            event.preventDefault(); 
            var formData = $(this).serialize(); 
        
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), 
                data: formData,
                success: function(response) {
                    console.log(123);
                    window.location = "order/create";
                },
                error: function(response) {
                    
                }
            });
        });
    }

    HT.updatePriceOfItem = () => {
        function updatePrice(element) {
            var price = element.find('option:selected').data('price-catalogue');
            if (price !== undefined && !isNaN(price)) {
                var formatPrice = price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                element.closest('tr').find('.product-price').text(formatPrice);
                element.closest('tr').find('.product-price').data('price', price);
            }
        }
    
        $('.price_catalogue').each(function() {
            updatePrice($(this));
        });
    
        $('.price_catalogue').change(function() {
            updatePrice($(this));
        });
    }
    

    HT.changePrice = () => {

        function updateTotalPrice() {
            var totalPrice = 0;
            var totalReducePrice = 0;
            var unpaidPrice = 0;
            var reducePrice = parseFloat($('#reduce_price').val());
            var reducePercentNumber = parseFloat($('#reduce_price_percent').val());
            var advancePrice = parseFloat($('#advance').val());

            if (isNaN(reducePrice) || reducePrice < 0) {
                reducePrice = 0;
            }

            if (isNaN(reducePercentNumber) || reducePercentNumber < 0) {
                reducePercentNumber = 0;
            }

            if (isNaN(advancePrice) || advancePrice < 0) {
                advancePrice = 0;
            }

            $('.total-price').each(function() {
                var formattedPrice = $(this).text().trim().replace(/\D/g, '');
                var price = parseFloat(formattedPrice);

                if(!isNaN(price)) {
                    totalPrice += price;
                }
            });

            var formattedTotalPrice = totalPrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND' })
            $('#order-total').val(formattedTotalPrice);


            if(reducePrice == 0 && reducePercentNumber == 0) {
                totalReducePrice = totalPrice;
            }

            if(reducePrice > 0) {
                totalReducePrice = totalPrice - reducePrice;
            }

            if(reducePercentNumber > 0) {
                var reducePricePercent = totalPrice * reducePercentNumber / 100;
                totalReducePrice = totalPrice - reducePricePercent;
            }

            if(advancePrice == 0) {
                unpaidPrice = totalReducePrice;
            }

            if(advancePrice > 0) {
                unpaidPrice = totalReducePrice - advancePrice;
            }

            var formattedTotalReducePrice = totalReducePrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND' })
            $('#completePrice').val(formattedTotalReducePrice);

            var formattedUnpaidPrice = unpaidPrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND' })
                $('#unpaidPrice').val(formattedUnpaidPrice);
        }

        function changeTotalComplete() {
            $('#reduce_price, #reduce_price_percent').on('input', function() {
                var completePrice = 0;
                var totalPrice = parseFloat($('#order-total').val().replace(/\D/g, ''));
                var reducePrice = 0;

                console.log(totalPrice);
        
                if ($(this).attr('id') === 'reduce_price') {
                    reducePrice = parseFloat($(this).val());
                    if (isNaN(reducePrice) || reducePrice < 0) {
                        reducePrice = 0;
                    }
                    if (reducePrice > totalPrice) {
                        alert("Số tiền nhập trừ vượt quá số tiền cần trả");
                        // return;
                    }
                } else if ($(this).attr('id') === 'reduce_price_percent') {
                    var PercentNumber = parseFloat($(this).val());
                    if (isNaN(PercentNumber) || PercentNumber < 0) {
                        PercentNumber = 0;
                    }
                    reducePrice = totalPrice * PercentNumber / 100;
                }
        
                completePrice = totalPrice - reducePrice;
        
                var formattedCompletePrice = completePrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND' })
                $('#completePrice').val(formattedCompletePrice);
                $('#unpaidPrice').val(formattedCompletePrice);
            });
        }
        
        function changePriceUnpaid() {
            $('#advance').on('input', function() {
                var unpaidPrice = 0;
                var completePrice = parseFloat($('#completePrice').val().replace(/\D/g, ''));
                var advance = parseFloat($(this).val());

                if (isNaN(advance) || advance < 0) {
                    advance = 0;
                }

                if(advance > completePrice) {
                    alert('Tiền thu nhiều quá rồi');
                } else {
                    unpaidPrice = completePrice - advance;
                }

                var formattedUnpaidPrice = unpaidPrice.toLocaleString('vi-VN', {style: 'currency', currency: 'VND' })
                $('#unpaidPrice').val(formattedUnpaidPrice);
                
            })
        }

        changeTotalComplete();
        changePriceUnpaid();

        function updateTotalItemPrice($row) {
            var price = parseFloat($row.find('.product-price').data('price'));
            var quantity = parseFloat($row.find('.quantity-input').val());

            if (isNaN(quantity) || quantity < 0) {
                quantity = 0;
            }
    
            var total = price * quantity;
            
            var formattedTotal = total.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
            $row.find('.total-price').text(formattedTotal);
            updateTotalPrice();
        }
    
        $('.quantity-input').on('input', function() {
            var $row = $(this).closest('.product-row');
            updateTotalItemPrice($row);
        });
    
        $('.price_catalogue').on('change', function() {
            var $row = $(this).closest('.product-row');
            updateTotalItemPrice($row);
        });
    }
    

    HT.changeCodeService = () => {
        var currentNumber = 0;

        function formatNumber(num) {
            var formatted = "000000" + num;
            return formatted.slice(-7);
        }

        
        function increaseNumber() {
            currentNumber++;
            $("#code").val(formatNumber(currentNumber));
        }

        $("#increaseButton").click(function() {
            increaseNumber();
        });
    }

    $(document).ready(function() {
        HT.select2();
        HT.changeStatus();
        HT.changerStatusAll();
        HT.checkAll();
        HT.checkItem();
        HT.updatePriceOfItem();
        HT.changePrice();
        // HT.changeCodeService();
        // HT.changeCreateCustomerModal();
    })
})(jQuery);