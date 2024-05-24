

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
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/main.js'])
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- /* Font Awsome Cdn */ -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TAble -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/kt-2.7.0/r-2.3.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sr-1.1.1/datatables.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">


    @stack('styles')
</head>

<body class="font-Poppins lg:min-h-screen bg-[#f4f7ff]">
    {{-- <div class="flex justify-start items-start relative">
        <x-seller-side-navbar/>
        <div class="flex-shrink-0 w-full px-4 lg:pl-[220px]">
            <x-seller-navigation/>
            <main>
                {{ $slot }}
            </main>
        </div>
    </div> --}}
    <div class="flex justify-start items-start relative">
        <livewire:seller.seller-side-navbar />
        <div class="flex-shrink-0 w-full px-4 lg:pl-[220px]">

            <div class="col-span-12 lg:col-span-11 px-4">

                {{-- <x-seller-navigation/> --}}
                <livewire:seller.seller-navigation/>

                <main>
                    {{$slot}}
                </main>
                <div class="sticky bottom-4  ">
                    <livewire:order-placed-notification/>
                    <livewire:message-notification />
                </div>
            </div>


        </div>
    </div>


    @stack('modals')
    @livewireScripts

    <script  type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script  type="text/javascript" src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/kt-2.7.0/r-2.3.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sr-1.1.1/datatables.min.js"></script>
    <script type="text/javascript" src="{{ asset('chartjs.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8JLKSMWWN4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8JLKSMWWN4');
    </script>
    <x-livewire-alert::scripts />
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
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3507892,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


    @stack('scripts')




</body>
</html>
