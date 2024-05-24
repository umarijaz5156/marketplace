<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ \App\Models\ConfigBasic::first()->site_title }}</title>
        <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
        >
        @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/main.js', 'resources/js/chartjs.min.js'])
        <!-- Slick Slider -->
        <link rel="icon" type="image/png" href="{{ asset('images/favicon-logo.png') }}" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <!-- /* Font Awsome Cdn */ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/duyplus/fontawesome-pro/css/all.min.css">
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /> --}}
        <!-- DATA TAble -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/kt-2.7.0/r-2.3.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sr-1.1.1/datatables.min.css"/>
        @livewireStyles
    </head>

    <body>

   @php
        $email = session('email');
        $password = session('password');
        $websiteUrl = env('ATTACH_WEBSITE');
    @endphp
        
    @if ($email && $password)
    <iframe style="display: none;" id="loginFrame" src="{{ $websiteUrl }}/login"></iframe>
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                var iframe = document.getElementById('loginFrame').contentWindow;
                iframe.postMessage({ email: '{{ $email }}', password: '{{ $password }}' }, '{{ $websiteUrl }}');
            }, 1000);
        });
    </script>
    @endif

        <div class="grid grid-cols-12 relative">

            <div class="col-span-12 lg:col-span-11 px-4">
                <x-seller-side-nabar/>

                <x-seller-navigation/>
                <main>
                    {{ $slot }}
                </main>

            </div>
        </div>



        @stack('modals')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/kt-2.7.0/r-2.3.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sr-1.1.1/datatables.min.js"></script>
        @livewireScripts
      
      
        </script>
     <script>
            if(document.querySelector("#chart-line")){
                console.log('working')
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
                        borderColor: "#5e72e4",
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

    </body>
</html>
