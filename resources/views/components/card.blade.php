<div class="item  md-2">
    <div class="prd_box">
        <div class="prd_img">
            <a href="{{ route('productByCategory', $product->slug) }}">

                @if (count($product->images))
                    <img src="{{ asset($product->images[0]->image_url) }}" class="img-fluid">
                @else
                    <img src="{{ asset('frontend/assets/images/cash-carry.png') }}" class="img-fluid product-thumb">
                @endif
            </a>
        </div>

        <p class="prd_name">{{ $product->name }}</p> 
        <span class="qty d-block">({{ $product->weight }}{{ $product->weight_type }})</span>

        {{-- <span class="ratings">
            @for ($i = 1; $i <= 5; $i++)
                <i class="{{ $i <= 4 ? 'bx bxs-star' : 'bx bx-star' }}"></i>
            @endfor
        </span> --}}

        <div class="qty-list input-group align-self-center">
            <a type="button" data-id="{{ $product->id }}" class="d-flex justify-content-center align-items-center button-minus qtyDecrement">-</a>
            <input type="text" step="1" value="1" name="quantity" id="quantity-{{ $product->id }}" class="quantity-field quantity-{{ $product->id }}">
            <a type="button" data-id="{{ $product->id }}" class="d-flex justify-content-center align-items-center button-plus qtyIncrement">+</a>
        </div>

        <div class="add_cart d-flex justify-content-between align-items-center">
            <p class="price mb-0">
                ${{ $product->price }} 
                @if ($product->special_price)
                    <s>{{ $product->special_price }}</s>
                @endif
            </p>

            @if (isset($product->inventory) && $product->inventory->inventory > 0)
                <a class="add_cart_btn btn addToCart" data-id="{{ $product->id }}">
                    <i class='bx bx-cart-add me-1'></i> Add to cart
                </a>
            @else
                <a class="add_to_cart bg-danger text-white d-inline-block py-2 px-4" data-id="{{ $product->id }}">
                    Out Of Stock
                </a>
            @endif
        </div>
    </div>
</div>
