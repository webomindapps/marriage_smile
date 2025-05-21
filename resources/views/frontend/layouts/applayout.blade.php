<html lang="en">
<html itemscope itemtype="http://schema.org/Website" lang="en">

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Marriage Contract</title>
    <link rel="icon" type="image/ico" href="./images/LOGO.png" sizes="32x32">
    <link defer rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/2.1.1/animate.min.css" />
    <link defer rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link defer rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link async href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="css/locomotive-scrollbar.css"> -->
    @stack('styles')
    @vite('resources/js/app.js')
</head>

<body>
    @include('frontend.layouts.header')
    @if (session('success'))
        <div class="col-lg-12 mt-2 session-success" id="session-success">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="col-lg-12 mt-2 session-error" id="session-success">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    @endif
    @yield('main')
    @include('frontend.layouts.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyEXAMPLEKEY123456789&libraries=places"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('scripts')

    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <script>
        new WOW().init(

        );
    </script>


    <script>
        let portfolio_lists = gsap.utils.toArray(".portfolio__item")
        portfolio_lists.forEach((portfolio, i) => {
            gsap.set(portfolio, {
                opacity: 0.7
            })
            let t1 = gsap.timeline()

            t1.set(portfolio, {
                position: "relative",
            })
            t1.to(portfolio, {
                scrollTrigger: {
                    trigger: portfolio,
                    scrub: 2,
                    duration: 1.5,
                    start: "top bottom",
                    end: "center bottom",
                },
                scale: 1,
                opacity: 1,
                rotateX: 0,
            })
        });

        gsap.to(".bg_image img", {
            xPercent: -20,
            scrollTrigger: {
                trigger: ".portfolio__area",
                start: "top bottom",
                end: "center bottom",
                pin: ".bg_image",
                scrub: 2,
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            "allowd" == localStorage.getItem("cookie-enable") ? $(".cookies").hide() : $(".cookies").show(),
                setInterval(function() {
                    $(".brand-item.item-1").hasClass("active") ? $(".brand-item.item-1").removeClass("active") :
                        $(".brand-item.item-1").addClass("active")
                }, 4e3),
                setInterval(function() {
                    $(".brand-item.item-2").hasClass("active") ? $(".brand-item.item-2").removeClass("active") :
                        $(".brand-item.item-2").addClass("active")
                }, 4500),
                setInterval(function() {
                    $(".brand-item.item-3").hasClass("active") ? $(".brand-item.item-3").removeClass("active") :
                        $(".brand-item.item-3").addClass("active")
                }, 5500),
                setInterval(function() {
                    $(".brand-item.item-4").hasClass("active") ? $(".brand-item.item-4").removeClass("active") :
                        $(".brand-item.item-4").addClass("active")
                }, 5500),
                setInterval(function() {
                    $(".brand-item.item-5").hasClass("active") ? $(".brand-item.item-5").removeClass("active") :
                        $(".brand-item.item-5").addClass("active")
                }, 6000),
                setInterval(function() {
                    $(".brand-item.item-6").hasClass("active") ? $(".brand-item.item-6").removeClass("active") :
                        $(".brand-item.item-6").addClass("active")
                }, 6500)
            setInterval(function() {
                $(".brand-item.item-7").hasClass("active") ? $(".brand-item.item-7").removeClass("active") :
                    $(".brand-item.item-7").addClass("active")
            }, 7000)
        }), $(".cookies-button").on("click",
            function() {
                localStorage.setItem("cookie-enable", "allowd"), $(".cookies").hide()
            });
    </script>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        let horizontalSection = document.querySelector('.horizontal');

        console.log(horizontalSection.scrollWidth);

        gsap.to('.horizontal', {
            x: () => horizontalSection.scrollWidth * -1,
            xPercent: 100,
            scrollTrigger: {
                trigger: '.horizontal',
                start: 'center center',
                end: '+=1400px',
                pin: '#horizontal-scoll',
                scrub: true,
                invalidateOnRefresh: true
            }
        });
    </script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>
    <script>
        $(document).ready(function() {
            const items = document.querySelectorAll('.accordion button');

            function toggleAccordion() {
                const itemToggle = this.getAttribute('aria-expanded');

                for (i = 0; i < items.length; i++) {
                    items[i].setAttribute('aria-expanded', 'false');
                }

                if (itemToggle == 'false') {
                    this.setAttribute('aria-expanded', 'true');
                }
            }

            items.forEach((item) => item.addEventListener('click', toggleAccordion));
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.counting').each(function() {
                var $this = $(this),
                    countTo = $this.attr('data-count');

                $({
                    countNum: parseInt($this.text(), 10)
                }).animate({
                    countNum: countTo
                }, {
                    duration: 6000,
                    easing: 'linear',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.toggle-password', function() {
                var passwordField = $(this).siblings('.input-password');
                var icon = $(this).find('i');

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });
        });
    </script>
</body>

</html>
