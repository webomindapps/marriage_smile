<x-admin-layout>
    <x-admin.breadcrumb title="Edit Faq" />

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
            <form method="POST" class="formSubmit" action="{{ route('admin.faq.edit', $faq->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <x-forms.textarea label="Question" type="text" name="question" id="question" :required="true"
                        size="col-lg-6 mt-4 p-3" :value="old('question', $faq->question)" />

                    <x-forms.textarea label="Answer" type="text" name="answer" id="answer" :required="true"
                        size="col-lg-6 mt-4 p-3" :value="old('answer', $faq->answer)" />

                    <x-forms.input label="Position" type="text" name="position" id="position" :required="true"
                        size="col-lg-6 mt-2 p-3" :value="old('position', $faq->position)" value="1" />

                </div>
                <button type="submit" class="submit-btn submitBtn" id="submitButton">Submit</button>
            </form>
        </div>
    </div>
</x-admin-layout>
