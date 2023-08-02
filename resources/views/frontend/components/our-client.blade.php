<div class="clint_section section_padding">
    <div class="container">
        <!-- clint slider -->
        <div class="clint_slider">
            <!-- clint item -->
            @isset($ourClients)
                @foreach ($ourClients as $key=> $client)
                <div class="clint_item">
                    <img src="{{asset('assets/images/uploads/our-client/' . $client->logo)}}" alt="">
                </div>
                @endforeach
            @endisset


        </div>
    </div>
</div>
