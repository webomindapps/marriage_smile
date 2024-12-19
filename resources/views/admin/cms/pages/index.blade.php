<x-admin-layout>
    <x-admin.breadcrumb title="Page List" :create="route('admin.pages.create')" />

    @php

        $columns = [
            ['label' => 'Id', 'column' => 'id', 'sort' => true],
            ['label' => 'Name', 'column' => 'name', 'sort' => true],
            ['label' => 'Slug', 'column' => 'slug', 'sort' => true],
            ['label' => 'Position', 'column' => 'position', 'sort' => true],
            ['label' => 'Title', 'column' => 'title', 'sort' => true],
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

    <x-table :columns="$columns" :data="$pages" checkAll="{{ true }}" :bulk="route('admin.pages.bulk')" :route="route('admin.pages')">
        @foreach ($pages as $key => $item)
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->slug }}</td>
                <td>{{ $item->position }}</td>
                <td>{{ $item->title }}</td>

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
                                <a class="dropdown-item" href="{{ route('admin.pages.edit', $item->id) }}">
                                    <i class='bx bx-edit-alt'></i>
                                    Edit
                                </a>
                                <a class="dropdown-item" onclick="return confirm('Are you sure to delete this?')"
                                    href="{{ route('admin.pages.delete', $item->id) }}">
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
