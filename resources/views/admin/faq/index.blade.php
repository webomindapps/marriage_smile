<x-admin-layout>
    <x-admin.breadcrumb title="FAQ'S" :create="route('admin.faq.create')" />

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Question', 'column' => 'question', 'sort' => true],
            ['label' => 'Answer', 'column' => 'answer', 'sort' => true],
            ['label' => 'Position', 'column' => 'position', 'sort' => true],
            ['label' => 'Status', 'column' => 'status', 'sort' => false],
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
    <x-table :columns="$columns" :data="$faq" checkAll="{{ true }}" :bulk="route('admin.faq.bulk')" :route="route('admin.faq')">
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
        @foreach ($faq as $key => $item)
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check"
                        value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td>
                    {{ implode(' ', array_slice(explode(' ', $item->question), 0, 5)) }}{{ str_word_count($item->question) > 5 ? '...' : '' }}
                </td>
                <td>
                    {{ implode(' ', array_slice(explode(' ', $item->answer), 0, 5)) }}{{ str_word_count($item->answer) > 5 ? '...' : '' }}
                </td>
                <td>{{ $item->position }}</td>
                <td>
                    @if ($item->status)
                        <span class="badge rounded-pill sactive">Active</span>
                    @else
                        <span class="badge rounded-pill deactive">In-Active</span>
                    @endif
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
                                <a class="dropdown-item" href="{{ route('admin.faq.edit', $item->id) }}">
                                    <i class='bx bx-edit-alt'></i>
                                    Edit
                                </a>
                                <a class="dropdown-item" onclick="return confirm('Are you sure to delete this?')"
                                    href="{{ route('admin.faq.delete', $item->id) }}">
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
