<x-admin-layout>
    <x-admin.breadcrumb title="Edit Testimonials" />

    @if ($errors->any())
        <div class="col-lg-12 pb-4 px-2">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.testimonials.edit', $testimonials->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-forms.input label="Name" type="text" name="name" id="name" :required="true"
                        size="col-lg-5 mt-4 p-3" class="name slug" :value="old('name',$testimonials->name)" />
                  
                        <div class="col-lg-6 mt-4">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image_url" id="image" class="form-control" />
    
                            @if ($testimonials->image_url)
                                <div class="mt-2">
                                    <img id="imagePreview" src="{{ asset('storage/' . $testimonials->image_url) }}"
                                        alt="Current Image"
                                        style="max-width: 100px; max-height: 100px; border: 1px solid #ccc; margin-top: 5px;" />
                                </div>
                            @endif
                        </div>

                        <x-forms.textarea label="Comments" type="text" name="comments" id="comments" :required="true"
                        size="col-lg-8 mt-2 p-3" :value="old('comments',$testimonials->comments)" />
                    
                </div>
                <button type="submit" class="submit-btn submitBtn" id="submitButton">Submit</button>
            </form>
        </div>
    </div>
</x-admin-layout>