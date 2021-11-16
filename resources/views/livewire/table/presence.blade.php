<div>
    <x-data-table :data="$data" :model="$presences">
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
                <th>
                    Yang hadir
                </th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Tanggal presensi
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($presences as $presence)
                <tr x-data="window.__controller.dataTableController({{ $presence->id }})">
                    <td>{{ $presence->id }}</td>
                    <td>{{ $presence->module }}</td>
                    <th>
                        {{ \App\Models\FeatureActivityPresence::wherePresenceStatusId(1)->whereFeatureActivityId($presence->id)->get()->count().'/'.$presence->featureActivityPresences->count() }}
                    </th>
                    <td>{{ $presence->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.presence.show',[$presence->iaf_id,$presence->id]) }}" class="mr-2">
                            <i class="fa fa-16px fa-eye text-primary">Presensi</i>
                        </a>
                        <br>
                        <br>
                        <a role="button" href="{{ route('admin.presence.edit',[$presence->iaf_id,$presence->id]) }}" class="mr-2">
                            <i class="fa fa-16px fa-pencil text-primary">Ubah</i>
                        </a>
                        <br>
                        <br>
                        <a role="button" x-on:click.prevent="deleteItem" href="#" class="mr-2">
                            <i class="fa fa-16px fa-trash text-red-500">Hapus</i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
