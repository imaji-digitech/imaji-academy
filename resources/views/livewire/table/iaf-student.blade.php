<div>
    <x-data-table :data="$data" :model="$iafs">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a>
                </th>
                <th><a wire:click.prevent="sortBy('user_id')" role="button" href="#">
                        Name Siswa
                        @include('components.sort-icon', ['field' => 'user_id'])
                    </a>
                </th>
                <th>Presensi</th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($iafs as $iaf)
                <tr x-data="window.__controller.dataTableController({{ $iaf->id }})">
                    <td>{{ $iaf->student->nis }}</td>
                    <td>{{ $iaf->student->name }}</td>
                    <td>
                        @php($count=0)
                        @php($presence=0)
                        @foreach($iaf->student->featureActivityPresences as $fap)
                            @if($fap->featureActivity->iaf_id==$iaf->iaf_id)
                                @php($count+=1)
                                @if($fap->presence_status_id==1 )
                                    @php($presence+=1)
                                @endif
                            @endif
                        @endforeach
                            {{$presence}}/{{$count}}

                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" x-on:click.prevent="deleteItem" href="#">
                            <i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
