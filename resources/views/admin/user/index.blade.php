<x-admin-layout>
    <x-admin.breadcrumb title="Customer User List"  />

    @php

        $columns = [
            ['label' => '', 'column' => '', 'sort' => false],
            ['label' => 'Id', 'column' => 'id', 'sort' => true],
            ['label' => 'Name', 'column' => 'name', 'sort' => true],
            ['label' => 'Customer Id', 'column' => 'customer_id', 'sort' => true],
            ['label' => 'Date Of Birth', 'column' => 'dob', 'sort' => true],
            ['label' => 'Email', 'column' => 'email', 'sort' => true],
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

    <x-table :columns="$columns" :data="$user" checkAll="{{ true }}" :bulk="route('admin.pages.bulk')" :route="route('admin.user')">
        @foreach ($user as $key => $item)
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->customer_id }}</td>
                <td> {{ \Carbon\Carbon::parse($item->dob)->format('d-m-Y') }}</td>
                <td>{{ $item->email }}</td>

                <td>
                    <div class="dropdown pop_Up dropdown_bg">
                        <div class="dropdown-toggle" id="dropdownMenuButton-{{ $item->id }}" data-bs-toggle="dropdown"
                            aria-expanded="true">
                            Action
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                            style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(-95px, -25.4219px);"
                            data-popper-placement="top-end">
                            <li>
                                {{-- <a class="dropdown-item" href="{{ route('admin.pages.edit', $item->id) }}">
                                    <i class='bx bx-edit-alt'></i>
                                    Edit
                                </a> --}}
                                <a class="dropdown-item" onclick="return confirm('Are you sure to delete this?')"
                                    href="{{ route('admin.user.delete', $item->id) }}">
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
