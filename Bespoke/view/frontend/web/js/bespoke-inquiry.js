define([
   'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/mage',
    'mage/calendar',
    'mage/validation'
], function( $,modal){
        "use strict";
     function main(config, element) {
        $(".bespoke-inquiry-form").show();
        $(".modal-footer").show()
        var dataForm = $('#form-validate');
        var AjaxUrl = config.AjaxUrl;
        dataForm.mage('validation', {});
        $('#date-range').dateRange({
            buttonText: 'Select Date',
            from: {
                id: 'from_date'
            },
            to: {
                id: 'to_date'
            }
        });
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            modalClass: 'custom-popup-modal',
            buttons: [{
                text: $.mage.__('Submit'),
                class: 'button',
                click: function () {
                   var status = dataForm.validation('isValid'); //validates form and returns boolean
                   if(status){
                     var param = dataForm.serialize();
                      $.ajax({
                        showLoader: false,
                        url: AjaxUrl,
                        data: param,
                        type: "POST"
                        }).done(function (data) {
                            var responseData = JSON.parse(data);
                            if(responseData.types=='mage-success'){
                                dataForm.trigger("reset");
                                $('[success-message]').text(responseData.message);
                                $(".bespoke-inquiry-form").hide();
                                $(".modal-footer").hide();
                                setTimeout(function () {
                                    $('[success-message]').text("")
                                    $('#custom-popup-modal').modal('closeModal');
                                }, 6000);
                            }
                            return true;
                        })
                        .fail(function() {
                            console.log("error");
                        });
                   }else{
                     console.log('form is not validated');
                    }
                }
            }]
        };
        var popup = modal(options, $('#custom-popup-modal'));
        $( document ).ready(function() {
            $('#custom-popup-modal').modal('openModal');
            // $(".margin-top-global").click(function(){
            //     $(".bespoke-inquiry-form").show();
            //     $(".modal-footer").show();
            //     var popup = modal(options, $('#custom-popup-modal'));
            //     $('#custom-popup-modal').modal('openModal')
            // })
        }); 
     };
    return main;
    }
);