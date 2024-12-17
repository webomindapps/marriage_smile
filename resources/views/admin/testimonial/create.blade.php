<x-admin-layout>
    <x-admin.breadcrumb title="Add Testimonials" />

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
            <form method="POST" class="formSubmit" action="{{ route('admin.testimonials.create') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-forms.input label="Name" type="text" name="name" id="name" :required="true"
                        size="col-lg-5 mt-4 p-3" class="name slug" :value="old('name')" />
                  
                    <x-forms.input label="Upload Image" type="file" name="image_url" id="image_url" :required="false"
                        size="col-lg-6 mt-4 p-3" :value="old('image_url')" class="image-file" :image="true" />

                        <x-forms.textarea label="Comments" type="text" name="comments" id="comments" :required="true"
                        size="col-lg-8 mt-2 p-3" :value="old('comments')" />
                    
                </div>
                <button type="submit" class="submit-btn submitBtn" id="submitButton">Submit</button>
            </form>
        </div>
    </div>
</x-admin-layout>