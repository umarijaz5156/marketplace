<x-app-layout>
    {{-- <x-slot name="header"><div class="mt-8 mr-8 sticky  flex justify-end">
        <a class="" href="{{route('home')}}"> << Go Back</a>
        </div></x-slot> --}}


    <!-- Hero Section  -->
   <div class=" flex items-center bg-hero">
    <div class="container mx-auto px-4 pt-[60px] lg:pt-[150px] pb-5">
       <div class="grid md:grid-cols-2 gap-6 place-items-center lg:place-items-start">
            <div class="flex justify-start items-center w-full h-full order-1 md:order-0" data-aos="fade-right">
               <div class="">
                    <h1 class="text-[#141414] text-[35px] md:text-[50px] md:leading-[56px] lg:text-[50px] leading-[50px] 2xl:text-[73px] 2xl:leading-[72px] font-bold mt-3">Privacy Policy</h1>
                    <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal mt-[22px]">
                        TheHotBleep Online Marketplace, Inc., currently owns and operates the mobile application known as TheHotBleep Freelance Marketplace (the “Application”) and the website known as www.TheHotBleep.com (the "Site"). The Application and the Site shall be collectively referred to as the “Service”.
                    </p>
                    <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal mt-[22px]">
                        The term "you" refers to the user or viewer of the Service. If you do not agree with any terms in this Privacy Policy ("Policy"), please discontinue use of the Service. Please read this privacy policy (the "Policy") carefully to understand how we use your personal information. By accessing or using this Service, you agree to this Policy. This Policy may change from time to time. If there are any material changes to how your personal information is used, we will notify you. Your continued use of the Service after we make changes is deemed to be acceptance of those changes, so please check the Policy periodically for update.
                    </p>
                    <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal mt-[22px]">
                        To better protect your privacy we provide this notice explaining our online information practices and the choices you can make about the way your information is collected and used and what rights you have in relation to it. To make this notice easy to find, we make it available on our homepage and at every point where personally identifiable information may be requested.
                    </p>
               </div>
            </div>
            <div class="relative flex items-center w-full h-full order-0 md:order-1"  data-aos="fade-left">
                <img class=" mx-auto my-auto" src="{{asset('images/protection-key-lock-icon 1.svg')}}" alt="">
            </div>
       </div>
    </div>
   </div>
   <!-- Hero Section  -->

   <div class="">
    <div class="container mx-auto px-4">
        <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal" data-aos="fade-up">
            At TheHotBleep we care about your privacy. We do not sell or rent your personal information to third parties for their direct marketing purposes without your explicit consent. We do not disclose it to others except as disclosed in this Policy or required to provide you with the services of the Site and the Application, meaning - to allow you to buy, sell, share the information you want to share on the Service; to contribute on the forum; pay for products; post reviews and so on; or where we have a legal obligation to do so..
        </p>
        <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal" data-aos="fade-up">
            We collect information that you provide us or voluntarily share with other users, and also some general technical information that is automatically gathered by our systems, such as IP address, browser information and cookies to enable you to have a better user experience and a more personalized browsing experience.
        </p>
        <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal" data-aos="fade-up">
            We will not share information that you provide us in the process of the registration - including your contact information - except as described in this Policy.
        </p>
        <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal" data-aos="fade-up">
            Information that you choose to publish on the Service (photos, videos, text, music, reviews, deliveries) - is no longer private, just like any information you publish online.
        </p>
         <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal" data-aos="fade-up">
            Technical information that is gathered by our systems, or third party systems, automatically may be used for Service operation, optimization, analytics, content promotion and enhancement of user experience. We may use your information to contact you - to provide notices related to your activities, or offer you promotions and general updates, but we will not let any other person, including sellers and buyers, contact you, other than through your user profile on the Service.
        </p>
        <p class="text-[#5E6282] text-[16px] leading-[22px] font-normal" data-aos="fade-up">
            Your personal information may be stored in systems based around the world, and may be processed by third party service providers acting on our behalf. These providers may be based in countries that do not provide an equivalent level of protection for privacy as that enjoyed in the country in which you live. In that case, we will provide for adequate safeguards to protect your personal information. You can exercise your rights over your personal information, by opening a Customer Relations ticket. If you do not have an active TheHotBleep account, please contact us at support@TheHotBleep.com. More details about the rights applicable to you are in the long version of the Policy. The above are just the highlights. We encourage you to read more about the information we collect, how we use it, understand the meaning of cookie (no, you can’t eat it) and more in the long version of our Policy below.
        </p>

    </div>
   </div>
   <!-- NewsLetter -->
   <div class="mt-[80px] mb-[35px]">
    {{-- <div class="container mx-auto px-4">
        <div class="relative">
            <img src="./images/newsletter.png" class="absolute md:right-[-38px] right-0 top-[-85px] sm:top-[-55px] z-[3]" alt="">
            <img src="./images/Group 5.png"class="absolute md:right-[-38px] right-0 bottom-[-55px] z[-1]" alt="">
            <div class="bg-[#F4C9F2] bg-opacity-[0.2] p-9 sm:p-[60px] rounded-tl-[97px] rounded-[15px] relative overflow-hidden">
                <img src="./images/mask2.png" class="absolute right-[-38px] top-[-55px] opacity-20 z[-1]" alt="">
                <img src="./images/Mask Group.png" class="absolute left-[38px] bottom-[-55px] z[-1]" alt="">
                <div class="text-left sm:text-center">
                    <h1 class="sm:text-[30px] text-[20px]  font-semibold sm:leading-[40px] text-[#5E6282]">Lorem ipsum dolor sit amet. Sit impedit quasi sit  <br class="hidden sm:block">
                        voluptatibus sapiente quo facilis voluptas </h1>
                </div>
                <div class="mt-[60px] relative z-[1]">
                    <form class="flex items-center max-w-[470px] w-full mx-auto flex-col gap-5 sm:gap-0 sm:flex-row">
                        <label for="voice-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" viewBox="0 0 24 21" fill="none">
                                    <path d="M4.77033 7.63647L10.9995 12.3083C11.2677 12.5095 11.6364 12.5095 11.9046 12.3083L18.1338 7.63647" stroke="#39425D" stroke-width="0.754294" stroke-linecap="round"/>
                                    <rect x="0.692996" y="1.33198" width="22.6317" height="19.2908" rx="3.39432" stroke="#39425D" stroke-width="0.754294"/>
                                </svg>
                            </div>
                            <input type="text" id="voice-search" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  w-full pl-10 p-[16px_19px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" placeholder="Your Email" required>
                        </div>
                        <button type="submit" class="inline-flex justify-center items-center sm:max-w-[135px] w-full h-[50px] ml-2 text-sm font-medium bg-gradient-to-tr from-[#CFEBFE] to-[#ABDEFE] rounded-lg border  text-black focus:ring-4 focus:outline-none focus:ring-blue-300 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
   </div>
</x-app-layout>

