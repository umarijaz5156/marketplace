


    <div class="flex justify-start items-center bg-white w-full sm:max-w-[310px] sm:w-[95%] rounded-3xl h-[134px] mb-5 xl:mb-0">
        <img src="{{ asset('images/box-icons-main/Group 1.png') }}" alt="">
        <div class="ml-[21px]">
            <h5 class="2xl:text-2xl xl:text-[20px] text-2xl">
                {{$show ? '$' : ''}}{{$value}}
            </h5>
            <p>{{$title}}</p>
        </div>
    </div>

