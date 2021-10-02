<div>
    <x-data-table :data="$data" :model="$scores">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Nama Kegiatan
                        @include('components.sort-icon', ['field' => 'title'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Tanggal presensi
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($scores as $score)
                <tr x-data="window.__controller.dataTableController({{ $score->id }})">
                    <td>{{ $score->id }}</td>
                    <td>{{ $score->module }}</td>
                    <td>{{ $score->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" x-on:click.prevent="deleteItem" href="#">
                            <i class="fa fa-16px fa-trash text-red-500"></i>
                        </a>
                        <a role="button" href="{{ route('admin.score.show',[$score->iaf_id,$score->id]) }}">
                            <i class="fa fa-16px fa-eye text-primary"></i>
                        </a>
                        <a role="button" href="{{ route('admin.score.edit',[$score->iaf_id,$score->id]) }}">
                            <i class="fa fa-16px fa-pencil text-primary"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
