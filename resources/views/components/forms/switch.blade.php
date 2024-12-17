<div class="{{ $attributes->get('size') }} py-2 mt-2">
    <div class="form-check form-switch" style="padding-left: 4.5em;">
        <label class="form-check-label">{{ $label }}</label>
        <input type="checkbox" style="font-size: 30px !important;border-radius:15px !important;margin-top: -0.02em !important;" class="form-check-input"
            id="{{ $attributes->get('id') }}" name="{{ $attributes->get('name') }}" value="{{ $attributes->get('value') }}"
            @if (isset($checked) && $checked) checked @endif>
    </div>

</div>
