<div>
    <x-data-table :data="$data" :model="$logs">
        <x-slot name="head">
            <tr>
                <th>
                    <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Dilakukan pada
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a>
                </th>
                <th>
                    <a wire:click.prevent="sortBy('user_id')" role="button" href="#">
                        Oleh
                        @include('components.sort-icon', ['field' => 'user_id'])
                    </a>
                </th>
                <th>
                    Melakukan
                </th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($logs as $log)
                <tr x-data="window.__controller.dataTableController({{ $log->id }})">
                    <td>{{ $log->created_at->format('d/m/y h:i') }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->note }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
