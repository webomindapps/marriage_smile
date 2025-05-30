<x-admin-layout>
    <x-admin.breadcrumb title="Features" :create="route('admin.feature.create')" />

    @php

        $columns = [
            ['label' => 'Id', 'column' => 'id', 'sort' => true],
            ['label' => 'Name', 'column' => 'name', 'sort' => true],
            ['label' => 'Position', 'column' => 'position', 'sort' => true],
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

    <x-table :columns="$columns" :data="$features" checkAll="{{ false }}" :bulk="route('admin.features')" :route="route('admin.features')">
        @foreach ($features as $key => $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->position }}</td>
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
                                <a class="dropdown-item" href="{{ route('admin.feature.edit', $item->id) }}">
                                    <i class='bx bx-edit-alt'></i>
                                    Edit
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-table>
</x-admin-layout>
