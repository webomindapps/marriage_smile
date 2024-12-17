<section class="faqd">
    <div class="container">
        <h2 class="sec-heading  mb-4">
            Frequently Asked Questions / FAQ
        </h2>
        <div class="accordion">

            @foreach ($faqs as $item)
                <div class="accordion-item">
                    <button id="accordion-button-5" aria-expanded="false">
                        <span class="accordion-title">{{ $item->question }}
                        </span>
                        <span class="icon" aria-hidden="true"></span>
                    </button>
                    <div class="accordion-content">
                        <p>
                            {{ $item->answer }}

                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
