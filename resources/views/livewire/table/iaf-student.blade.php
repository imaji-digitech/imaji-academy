<div>
    <x-data-table :data="$data" :model="$iafs">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('imaji_academy_id')" role="button" href="#">
                        Name Imaji Academy
                        @include('components.sort-icon', ['field' => 'imaji_academy_id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('feature_id')" role="button" href="#">
                        Nama Fitur
                        @include('components.sort-icon', ['field' => 'feature_id'])
                    </a></th>
                <th>
                    Jumlah siswa
                </th>
                <th>
                    Jumlah tutor
                </th>
                <th>
                    Jadwal fitur
                </th>
                <th><a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                        Tanggal Dibuat
                        @include('components.sort-icon', ['field' => 'created_at'])
                    </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($iafs as $iaf)
                <tr x-data="window.__controller.dataTableController({{ $iaf->id }})">
                    <td>{{ $iaf->id }}</td>
                    <td>{{ $iaf->imajiAcademy->title }}</td>
                    <td>{{ $iaf->feature->title }}</td>
                    <td>{{ $iaf->featureStudents->count() }}</td>
                    <td>{{ $iaf->featureTeachers->count() }}</td>
                    <td>
                        @foreach($iaf->featureSchedules as $fs)
                            <div>{{$fs->created_at}}</div>
                        @endforeach
                    </td>
                    <td>{{ $iaf->created_at->format('d M Y H:i') }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="feature/edit/{{ $iaf->id }}" class="mr-1">
                            <i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" href="{{ route('admin.iaf.show-student',$iaf->id) }}" class="mr-1">
                            <i class="fa fa-16px fa-user"></i>Siswa</a>
                        <a role="button" href="{{ route('admin.iaf.show-teacher',$iaf->id) }}" class="mr-1">
                            <i class="fa fa-16px fa-user"></i>Tutor</a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#">
                            <i class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
