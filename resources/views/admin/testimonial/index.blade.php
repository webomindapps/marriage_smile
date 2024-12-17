<x-admin-layout>
    <x-admin.breadcrumb title="Testimonials" :create="route('admin.testimonials.create')" />

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Image', 'column' => 'image_url', 'sort' => true],
            ['label' => 'Name', 'column' => 'name', 'sort' => true],
            ['label' => 'Comments', 'column' => 'comments', 'sort' => true],
            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
        ];

        $bulkOptions = [
            [
                'label' => 'Status',
                'value' => '2',
                'options' => [
                    [
                        'label' => 'Active',
                        'value' => '1',
                    ],
                    [
                        'label' => 'Inactive',
                        'value' => '0',
                    ],
                ],
            ],
        ];
    @endphp
    <x-table :columns="$columns" :data="$testimonials" checkAll="{{ false }}" :bulk="route('admin.testimonials')" :route="route('admin.testimonials')">
        <x-slot:filters>
            <form action="" method="POST">
                @csrf
                <div class="row px-2">
                    <div class="col-lg-3">
                        <div class="cdate">
                            <input type="date" class="form-control" name="from_date" id="from_date">
                        </div>
                    </div>
                    <div class="col-lg-1 text-center my-auto">
                        <span class="fw-semibold fs-6">To</span>
                    </div>
                    <div class="col-lg-3">
                        <div class="cdate">
                            <input type="date" class="form-control" name="to_date" id="to_date">
                        </div>
                    </div>

                </div>
            </form>
        </x-slot:filters>
        @foreach ($testimonials as $key => $item)
            <tr>
             
                <td>{{ $key + 1 }}</td>
                <td>
                    <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}" width="70px"
                        height="70px">

                </td>
                <td>{{ $item->name }}</td>
                <td>
                    {{ implode(' ', array_slice(explode(' ', $item->comments), 0, 5)) }}{{ str_word_count($item->comments) > 5 ? '...' : '' }}
                </td>

                <td>
                    <div class="dropdown pop_Up dropdown_bg">
                        <div class="dropdown-toggle" id="dropdownMenuButton-{{ $item->id }}"
                            data-bs-toggle="dropdown" aria-expanded="true">
                            Action
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                            style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(-95px, -25.4219px);"
                            data-popper-placement="top-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.testimonials.edit', $item->id) }}">
                                    <i class='bx bx-edit-alt'></i>
                                    Edit
                                </a>
                                <a class="dropdown-item" onclick="return confirm('Are you sure to delete this?')"
                                    href="{{route('admin.testimonials.delete',$item->id)}}">
                                    <i class='bx bx-trash-alt'></i>
                                    Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-table>
</x-admin-layout>
