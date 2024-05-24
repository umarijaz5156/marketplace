<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ \App\Models\ConfigBasic::first()->site_title }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/hotbleep.jpeg') }}" />

      <!-- /* Font Awsome Cdn */ -->
        <link
        href="https://cdn.jsdelivr.net/gh/duyplus/fontawesome-pro/css/all.min.css"
        rel="stylesheet"
        type="text/css"
        />
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
        />

        {{-- 'resources/js/homepage-v2.js' --}}
        <!-- Scripts -->
        {{-- resources/css/custom.css', 'resources/js/homepage-v2.js', 'resources/js/app.js', 'resources/js/main.js', 'resources/css/custom2.css' --}}
        @vite(['resources/css/app.css', 'resources/css/marketplace.css','resources/css/custom.css' ,'resources/js/app.js', 'resources/js/main.js'])

        <!-- Styles -->
        @stack('styles')
        @livewireStyles

    </head>
    <body   class="relative"
        x-data="{ scrolled: false }"
        x-init="() => {
            window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 50;
            });
        }">

        <div class='relative'>
            @stack('modals')
        </div>
        {{-- <div class="flex items-center justify-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>Giveaway Ended! 20 Free Shopify Stores Provided to Our Winners!</p>
          </div> --}}
            @if(isset($header))

                {{ $header }}
            @else
                @livewire('header')
            @endif


            <main class="{{ !isset($header) ? 'pt-28' : '' }}">
                {{ $slot }}
            </main>
            <div class="sticky bottom-4  ">
                <livewire:message-notification />

                <livewire:order-placed-notification/>
            </div>


            <x-HomePage.footer/>



        @stack('modals')
        @livewireScripts
        @vite(['resources/js/collapse.js'])


        <script
        src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
        crossorigin="anonymous"
      ></script>
        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}
        {{--
    --}}
        {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/kt-2.7.0/r-2.3.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sr-1.1.1/datatables.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        {{-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script type="text/javascript" src="{{ asset('chartjs.min.js') }}"></script>
       
        @stack('scripts')

     <script>

        if(document.querySelector("#chart-line")){

            var ctx1 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
            gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
            new Chart(ctx1, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#2646C4",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#fbfbfb',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#ccc',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8JLKSMWWN4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8JLKSMWWN4');
    </script>

    <script>
        window.intercomSettings = {
            api_base: "https://api-iam.intercom.io",
            app_id: "moi2v3ex"
        };
    </script>

    <script>
        // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/moi2v3ex'
        (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/moi2v3ex';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
    </script>


    <!-- Hotjar Tracking Code for https://pushiii.com/ -->
{{-- <script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3507892,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

 --}}

</body>
</html>