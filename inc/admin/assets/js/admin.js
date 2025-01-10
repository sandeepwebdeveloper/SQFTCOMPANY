/**
 * Show a spinner for the theme option page
 *
 * @author  Sohrab
 * @package msteele
 */
(function ($) {
    $(document).ready(function () {

        // create a random div element for the spinner
        var spinner_container = document.createElement('div');

        // get the variables
        var theme_options = document.getElementById("acf-group_msteel_theme_options");
        var them_option_container = document.getElementById('postbox-container-2');

        // insert the spinner
        spinner_container.innerHTML = '<div id="loading-spinner" class="loading-spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>';
        them_option_container.prepend(spinner_container);

        // get the spinner
        var spinner = document.getElementById('loading-spinner');

        // function to show the options model
        function show_options_model() {
            // hide the spinner
            spinner.style.display = "none";
            theme_options.setAttribute('style', 'display:block !important');
        }

        // set a timer to run the function after 1 second
        setTimeout(function () {
            show_options_model();
        }, 1000);

    });

})(jQuery);