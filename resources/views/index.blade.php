<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kyron Cruel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        .swiper {
          width: 100%;
          max-width: 100%;
          height: 300px;
          border-radius: 10px;
          overflow: hidden;
          position: relative; 
          margin-top: 100px;
        }
        .swiper-slide img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          display: block;
        }

   @media (max-width: 992px) {
        .swiper {
            height: 250px;
        }
    }

    /* HP layar sedang */
    @media (max-width: 768px) {
        .swiper {
            height: 180px;
        }
    }

    /* HP kecil banget (Android kecil/iPhone mini) */
    @media (max-width: 480px) {
        .swiper {
            height: 140px;
        }
    }
    </style>
</head>
<body class="bg-white text-gray-800">

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

    <div class="container mx-auto px-4 mt-6">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <a href="{{ $banner->link ?? '#' }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>
</html>