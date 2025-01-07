<x-admin-layout>
    <x-admin.breadcrumb title="Edit Feature" />

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
            <form action="{{ route('admin.feature.edit', $feature->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-contents">
                    <div class="row my-2">
                        <x-forms.input label="Name" type="text" name="name" id="name" :required="true"
                            size="col-lg-6" :value="$feature->name" class="" />
                        <x-forms.input label="Position" type="number" name="position" id="position" :required="true"
                            size="col-lg-6" :value="$feature->position" class="" />
                        <div class="col-lg-12">
                            <x-forms.button type="submit" label="Update" class="submit-btn" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
