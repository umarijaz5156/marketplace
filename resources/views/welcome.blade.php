<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

           <!-- font Style -->
        <link 
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
        >
        @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/main.js'])
        <!-- Slick Slider -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <!-- /* Font Awsome Cdn */ -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    </head>
    <body class="antialiased">
       
            {{-- header --}}
         
        
            {{-- hero section --}}
            <x-HomePage.hero-section/>

            {{-- explore the marketplace section --}}

            <livewire:home-page.categories />
   
            {{-- popluar professional services --}}
            <livewire:home-page.popular-services />

             <!-- Talent at Your Fingertips -->
             <livewire:home-page.talent-section />

             <!-- Make Logo In Minutes -->
             <livewire:home-page.make-logo />

             <!-- Inspired by work  -->
             <livewire:home-page.inspired-work />

              <!-- Bussiness Solution -->
              <livewire:home-page.buisness-solution />

              <!-- Fringe Guide -->
              <livewire:home-page.fringe-guide />
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
             
    </body>
</html>
