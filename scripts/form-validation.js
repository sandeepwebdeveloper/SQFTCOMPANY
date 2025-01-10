(function($) {
    $(document).ready(function() {
        $("#hasAgent").change(function() {
            $('.broker-name').css('display', ($(this).is(':checked')) ? 'flex' : 'none');
        });

        $("#isAgent").change(function() {
            $('.broker-company-name').css('display', ($(this).is(':checked')) ? 'block' : 'none');
        });

        $('input[type="text"]').on('focus', function() {
            $('label').removeClass('active');
            $(this).closest('.col-md-5').find('label').addClass('active');
        });
        $('input[type="email"]').on('focus', function() {
            $('label').removeClass('active');
            $(this).closest('.col-md-5').find('label').addClass('active');
        });
        $('input[type="text"]').on('change', function() {
            if ($(this).val() !== 0) {
                $(this).closest('.col-md-5').find('label').addClass('done');
            } else {
                $(this).closest('.col-md-5').find('label').removeClass('done');
            }
        });
        $('input[type="email"]').on('change', function() {
            if ($(this).val() !== 0) {
                $(this).closest('.col-md-5').find('label').addClass('done');
            } else {
                $(this).closest('.col-md-5').find('label').removeClass('done');
            }
        });
        $(".submit-form").click(function(event) {
            event.preventDefault();
            $("#subscribe").click();
        });

        $('#register form').on('submit', function(e) {

            $('#register .submit-form').addClass('disabled');
            var form_data = jQuery(this).serializeArray();
            form_data.push({
                "name": "security",
                "value": ajax_nonce
            });
            jQuery.ajax({
                url: ajax_url,
                type: 'post',
                data: form_data,
                success: function success(response) {
                    console.log("THis is working...");
                    console.log(response);
                    //console.log(err);
                    //event.preventDefault();
                    window.location = "/thank-you";
                },
                fail: function fail(err) {
                    $('#register .submit-form').removeClass('disabled');
                    console.log(response);
                    //console.log(err);
                    alert("There was an error: " + err);
                }
            });
            return false;
        });
        let countStrip = inStrip.length;
        let max = countStrip - 1;
        let min = 0;

        function myTimer() {
            const positionRand = Math.floor(Math.random() * (max - min + 1) + min);
            const position = positionRand + 1;
            const nodeImage = $(".filmstrip-items .single:nth-child(" + position + ")  img");
            const srcImage = nodeImage.attr("src");

            //push to outStrip, last position
            outStrip.push(srcImage);

            //shift first position image from outStrip
            const newImage = outStrip.shift();

            //replace image in inStrip
            inStrip.splice(positionRand, 1, newImage);

            //change src attribute and show the new image
            nodeImage.fadeOut(400, function() {
                nodeImage.attr("src", newImage);
            }).fadeIn(400);


        }
        if (outStrip.length) {
            const timer = setInterval(myTimer, 3000);
        }

    });

})(jQuery);