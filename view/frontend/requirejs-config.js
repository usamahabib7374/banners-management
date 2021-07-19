

var config = {
    paths: {
        'magedad/bannermanagement/jquery/popup': 'MageDad_BannerManagement/js/jquery.magnific-popup.min',
        'magedad/bannermanagement/owl.carousel': 'MageDad_BannerManagement/js/owl.carousel.min',
        'magedad/bannermanagement/bootstrap': 'MageDad_BannerManagement/js/bootstrap.min',
        IonRangeSlider: 'MageDad_BannerManagement/js/ion.rangeSlider.min',
        touchPunch: 'MageDad_BannerManagement/js/jquery.ui.touch-punch.min',
        DevbridgeAutocomplete: 'MageDad_BannerManagement/js/jquery.autocomplete.min'
    },
    shim: {
        "magedad/bannermanagement/jquery/popup": ["jquery"],
        "magedad/bannermanagement/owl.carousel": ["jquery"],
        "magedad/bannermanagement/bootstrap": ["jquery"],
        IonRangeSlider: ["jquery"],
        DevbridgeAutocomplete: ["jquery"],
        touchPunch: ['jquery', 'jquery/ui']
    }
};
