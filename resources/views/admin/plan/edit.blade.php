<x-admin-layout>
    <x-admin.breadcrumb title="Edit Plans" />

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
            <form action="{{ route('admin.plan.edit', $plan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-contents">
                    <div class="row my-2">
                        <x-forms.input label="Name" type="text" name="name" id="name" :required="true"
                            size="col-lg-6" :value="$plan->name" class="" />
                        <x-forms.input label="Position" type="number" name="position" id="position" :required="true"
                            size="col-lg-6" :value="$plan->position" class="" />
                        <x-forms.input label="Thumbnail" type="file" name="thumbnail" id="thumbnail"
                            :required="false" size="col-lg-6" :value="$plan->thumbnail" class="" />
                        <div class="col-lg-6">
                            <label for="form-lable">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Select Status</option>
                                <option {{ $plan->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                <option {{ $plan->status == 0 ? 'selected' : '' }} value="0">Not-Active</option>
                            </select>
                        </div>
                        <x-forms.textarea label="Description" name="description" id="description" :required="true"
                            size="col-lg-12" :value="$plan->description" />
                        <div class="col-lg-12">
                            <p>Prices</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Duration(in days)</th>
                                        <th>Price</th>
                                        <th>Special Price</th>
                                        <th>
                                            <span class="btn btn-info btn-sm" id="add_row">Add</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    @foreach ($plan->prices as $key => $item)
                                        <tr>
                                            <td>
                                                <input type="number" name="duration[]" value="{{ $item->duration }}">
                                            </td>
                                            <td>
                                                <input type="number" name="price[]" value="{{ $item->price }}">
                                            </td>
                                            <td>
                                                <input type="number" name="special_price[]"
                                                    value="{{ $item->special_price }}">
                                            </td>
                                            <td>
                                                <span class="del_row"><i class="bx bx-trash"></i></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="col-lg-12 mt-4">
                            <p class="mt-2">Features</p>

                            <div class="text-end mb-2">
                                <button type="button" id="add-feature-row" class="btn btn-primary btn-sm">Add
                                    Feature</button>
                            </div>

                            <table class="table table-bordered" id="features-table">
                                <thead>
                                    <tr>
                                        <th>Feature</th>
                                        <th>Feature Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Existing features (for editing) --}}
                                    @foreach ($plan->features as $feature)
                                        <tr>
                                            <td>
                                                <select name="feature_ids[]" class="form-control feature-dropdown">
                                                    <option value="">Select Feature</option>
                                                    @foreach ($features as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $feature->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="feature_values[]" class="form-control"
                                                    value="{{ old('feature_values.' . $loop->index, $feature->pivot->feature_value ?? '') }}"
                                                    placeholder="Enter value or 'Unlimited'">
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm remove-feature-row">Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        {{-- Pass features to JS --}}
                        <script>
                            const allFeatures = @json($features);
                        </script>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <x-forms.button type="submit" label="Update" class="submit-btn" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {

                // Add new row
                $('#add_row').on('click', function() {

                    let newRow = `
        <tr>
            <td>
                <input type="number" name="duration[]" value="0">
            </td>
            <td>
                <input type="number" name="prices[]" value="0">
            </td>
            <td>
                <input type="number" name="special_prices[]" value="0">
            </td>
            <td>
                <span class="del_row"><i class="bx bx-trash"></i></span>
            </td>
        </tr>
    `;

                    // Append the new row to the table body
                    $('#table_body').append(newRow);
                    attachDeleteEvents();
                });

                // Delete row
                function attachDeleteEvents() {
                    $('.del_row').off('click').on('click', function() {
                        $(this).closest('tr').remove();
                    });
                }
                attachDeleteEvents();
            });
        </script>
        <script>
            document.getElementById('add-feature-row').addEventListener('click', function() {
                const tableBody = document.querySelector('#features-table tbody');

                const featureOptions = allFeatures.map(feature => {
                    return `<option value="${feature.id}">${feature.name}</option>`;
                }).join('');

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>
                        <select name="feature_ids[]" class="form-control feature-dropdown">
                            <option value="">Select Feature</option>
                            ${featureOptions}
                        </select>
                    </td>
                    <td>
                        <input type="text" name="feature_values[]" class="form-control" placeholder="Enter value or 'Unlimited'">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-feature-row">Remove</button>
                    </td>
                `;

                tableBody.appendChild(newRow);
            });

            // Remove feature row
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-feature-row')) {
                    e.target.closest('tr').remove();
                }
            });
        </script>
    @endpush
</x-admin-layout>
