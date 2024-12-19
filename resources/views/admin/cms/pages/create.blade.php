<x-admin-layout>
    <x-admin.breadcrumb title="Add Pages" />

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
            <form action="{{ route('admin.pages.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-contents">
                    <div class="row my-2">
                        <x-additional.form-title title="General info" size="col-lg-12" />
                        <x-forms.input label="Name" type="text" name="name" id="name" :required="true"
                            size="col-lg-6" :value="old('name')" class="" />
                        <x-forms.input label="Position" type="number" name="position" id="position" :required="true"
                            size="col-lg-6" :value="old('position')" class="" />
                        <x-forms.input label="Title of description" type="text" name="title" id="title"
                            :required="true" size="col-lg-12" :value="old('title')" class="" />
                        <x-forms.textarea label="Description" name="description" id="description" :required="true"
                            size="col-lg-12" />
                    </div>
                    <x-additional.seo-form />
                    <div class="row">
                        <div class="col-lg-12">
                            <x-forms.button type="submit" label="Add" class="submit-btn" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>
