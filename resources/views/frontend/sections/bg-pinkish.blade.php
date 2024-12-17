<section class="bg-pinkish">
    <div class="container">
        <h5 class="h5-find">Finding your perfect</h5>
        <h2 class="sec-heading  mb-4">
            Success Stories
        </h2>
        <div class="row big-y">
            <div class="col-lg-10">
                <div class="owl-carousel owl-theme">
                    @foreach ($testimonials as $item)
                        <div class="item">
                            <div class="row box-j">

                                <div class="col-lg-5">
                                    <img src="{{ asset('storage/' . $item->image_url) }}"alt="{{ $item->name }}"
                                        class="img-fluid wid-testimoni">
                                </div>
                                <div class="col-lg-7">
                                    <div class="test-main">
                                        <p class="testi-suc-p">
                                            {{ $item->comments }}
                                        </p>
                                        <h6 class="testi-succes-h">{{ $item->name }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>
</section>
