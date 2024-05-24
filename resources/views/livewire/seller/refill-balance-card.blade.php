<div class="mt-[33px] bg-gradient-to-t from-[#0d101b] to-[#0b1020] p-4 rounded-3xl">
    <div class="flex justify-around items-center bg-[#d7dffd1e] p-[35px] rounded-3xl">
        <img src="{{ asset('images/box-icons-main/Layer 77.png')}} " alt="">
        <div>
            {{-- <p class="text-white text-xl mb-2">$0.00</p>
            <h5 class="text-[#A6B5EF] text-[16px]">Current Balance</h5> --}}
        </div>
    </div>
    <div class="text-center mt-[-21px] mb-[11px]">
        @if(auth()->user()->seller->stripe_onboarded)

        <button disabled class="btn bg-white rounded-[50px] inline-flex   border border-[#3858D6] text-[#2848C6] shadow-xl p-[15px_23px]">
            <svg class="w-8 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Withdrawl Configured </button>
        @else
        <form method="Post" action="{{ route('stripe.redirect', ['seller' => auth()->user()->seller]) }}">
            @csrf
        <button type="submit">
            <button class="btn bg-white rounded-[50px] border border-[#3858D6] text-[#2848C6] shadow-xl p-[15px_23px]">
                Configure Withdrawl</button>
        </a>
        </form>
        @endif
    </div>
</div>
