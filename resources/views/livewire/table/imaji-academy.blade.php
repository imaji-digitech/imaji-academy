<div>
    <x-data-table :data="$data" :model="$imajiAcademys">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Name
                        @include('components.sort-icon', ['field' => 'title'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('code')" role="button" href="#">
                        Code
                        @include('components.sort-icon', ['field' => 'code'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('village')" role="button" href="#">
                        Desa
                        @include('components.sort-icon', ['field' => 'village'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Fitur
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Jumlah siswa</th>
                <th>Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($imajiAcademys as $imajiAcademy)
                <tr x-data="window.__controller.dataTableController({{ $imajiAcademy->id }})">
                    <td>{{ $imajiAcademy->id }}</td>
                    <td>{{ $imajiAcademy->title }}</td>
                    <td>{{ $imajiAcademy->code }}</td>
                    <td>{{ $imajiAcademy->village }}</td>
                    <td>
                        @foreach($imajiAcademy->imajiAcademyFeatures as $iaf)
                            <div>{{$iaf->feature->title}}</div>
                        @endforeach
                    </td>
                    <td>
                        {{ $imajiAcademy->users->count() }}
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.imaji-academy.show',$imajiAcademy->id) }}" class="mr-1 btn btn-success">
                            <i class="fa fa-16px fa-eye"></i>
                        </a>
                        <a role="button" href="{{ route('admin.imaji-academy.edit',$imajiAcademy->id) }}" class="mr-1 btn btn-primary">
                            <i class="fa fa-16px fa-pen"></i>
                        </a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#" class="btn btn-danger">
                            <i class="fa fa-16px fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
