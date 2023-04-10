$(document).ready(function () {

    // Preloader;
    $(window).on('load', function () {
        $('.preloader').fadeOut(500);

    });

    // Search;
    $('#search-btn').on('click', function () {
        $('#search').addClass('show');
        return false;
    })

    $('#search-close').on('click', function () {
        $('#search').removeClass('show');
    })

    // Popup advertise;
    $(window).on('load', function () {
        $('.popup-bg').delay(1000).fadeIn(500);
    })

    // Page popup;
    $('.popup-overlay, .close-popup').click(function () {
        $('.popup-bg').fadeOut();
    });

    // Back to top;
    $(window).on('scroll', function () {
        if ($(this).scrollTop() >= 200) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    $('.back-to-top').on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    })

    // Main menu;
    function dropdownOnHover() {
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "fadeIn";

        $(window).on("load resize", function () {
            if (this.matchMedia("(min-width: 992px)").matches) {
                $dropdown.hover(
                    function () {
                        const $this = $(this);
                        $this.addClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "true");
                        $this.find($dropdownMenu).addClass(showClass);
                    },
                    function () {
                        const $this = $(this);
                        $this.removeClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "false");
                        $this.find($dropdownMenu).removeClass(showClass);
                    }
                );
            } else {
                $dropdown.off("mouseenter mouseleave");
            }
        });
    }
    dropdownOnHover();
    $("[data-trigger]").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var offcanvas_id = $(this).attr('data-trigger');
        $(offcanvas_id).toggleClass("show");
        $('body').toggleClass("offcanvas-active");
        $(".screen-overlay").toggleClass("show");
    });

    $(".btn-close, .screen-overlay").click(function (e) {
        $(".screen-overlay").removeClass("show");
        $(".mobile-offcanvas").removeClass("show");
        $("body").removeClass("offcanvas-active");
    });

    // Sticky menu;
    if (window.matchMedia("(min-width: 992px)").matches) {
        let scrollTop = $(window).scrollTop();
        if (scrollTop >= 200) {
            $('.bottom-header').addClass('sticky');
        }
    }
    $(window).on('scroll', function () {
        let scrollTop = $(this).scrollTop();
        if (scrollTop >= 100 && scrollTop < 300) {
            $('.bottom-header').addClass('set-top').removeClass('sticky');
        } else if (scrollTop >= 300) {
            $('.bottom-header').addClass('sticky').removeClass('set-top');
        } else {
            $('.bottom-header').removeClass('sticky set-top');
        }
    });

    // Filter btn;
    $('.filter-btn').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');

    })

    // Slick slider;
    $('.banner-slide').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="btn slick-prev"><i class="fas fa-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="btn slick-next"><i class="fas fa-arrow-right"></i></button>',
        autoplay: true
    });
    $('.client-logos').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="btn slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="btn slick-next"><i class="fas fa-chevron-right"></i></button>',
        autoplay: true,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3,
                    arrow: false
                }
            }
        ]
    });
    $('a.disabled').on('click', function (e) {
        e.preventDefault();
        return false;
    })

    // Price range;
    $(".price-range-scale").asRange({
        range: true,
        limit: true,
        tip: {
            active: 'onMove'
        },
        min: 0,
        max: 1000,
        step: 1,
        value: [0, 355, ],
        format: function (value) {
            return '$' + value;
        },
        onChange: function (value) {
            $('.price-from').text(value[0]);
            $('.price-to').text(value[1]);
        }

    });

    // Customer rating;
    $(".stars").rateYo({
        halfStar: true,
        starWidth: "18px",
        spacing: "3px",
        normalFill: "#ddd",
        ratedFill: "#16ccf5",
        readOnly: true,
    });

    // Quantity increase decrease
    $('body').on('click', '.counting .increase', function(){
        var curr_val = Number($('.counting span').text());
        var changed_val = curr_val + 1; 
        $('.counting span').text(changed_val);
    });
    $('body').on('click', '.counting .decrease', function(){
        var curr_val = Number($('.counting span').text());
        var changed_val = curr_val - 1; 
        if(curr_val == 0){
            $('.counting span').text('0');
        }else{
            $('.counting span').text(changed_val);
        }
    });
    var priceValue = $(".price-range-scale").asRange('get');

    $('.price-from').text(priceValue[0]);
    $('.price-to').text(priceValue[1]);

    $(".modal").on("hidden.bs.modal", function(){
        $("#quickview .modal-body").html("");
    });
});