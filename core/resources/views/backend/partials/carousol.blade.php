<script type="text/javascript" src="{{ asset('assets/common/owl-carousel/js/owl.carousel.min.js') }}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
    $(document).ready(function() {
        $('.services-carousel1').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                800: {
                    items: 2
                },

                1000: {
                    items: 2
                },
                1200: {
                    items: 3
                },
                1600: {
                    items: 3
                }
            }
        })
    });
</script>
