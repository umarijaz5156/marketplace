
@if ($errors->any())
   
    <div role="alert">
        <div class="bg-red-400 text-white font-bold rounded-t px-4 py-2">
        Somthing went wrong!
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <ul class="mt-3 list-disc list-inside text-sm text-red-400">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
