jQuery(function($){

    $(document).ready(function () {
        const zipInput = $(".zipcode");
        const checkoutButton = $("#btn");
    
        zipInput.blur(function () {
            const enteredZipCode = zipInput.val();
            if( zipInput.val() ) {
                $.ajax({
                    url: AJAX_OBJECT.ajax_url,
                    type: 'POST',
                    data: { 
                        action: 'cbs_shipping_zone_verify',
                        zipCode: enteredZipCode 
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        checkoutButton.prop('disabled', false);

                        if ( response.data.allowedZip.includes(response.data.zipcode)  ) {
                            Swal.fire({
                              title: "Shipping Zone Valid!",
                              text: "FREE!",
                              icon: "success"
                            });
                        } else {
                            Swal.fire({
                              title: "Shipping Zone Invalid!",
                              text: "Try different shipping zone",
                              icon: "error"
                            });
                            zipInput.val('');
                        }
                    },
                    error: function () {
                        console.log ("Error: Unable to validate ZIP code.");
                    }
                });
            }
           

        });
    });   

});
