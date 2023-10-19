<div>
    <x-data-table :data="$data" :model="$students">
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('id')" role="button" href="#">
                        ID
                        @include('components.sort-icon', ['field' => 'id'])
                    </a></th>
                <th><a wire:click.prevent="sortBy('name')" role="button" href="#">
                        Nama
                        @include('components.sort-icon', ['field' => 'name'])
                    </a></th>
                <th>
                    Imaji Academy
                </th>
                <th>
                    Fitur
                </th>
                <th>
                    Presensi
                </th>
                <th>Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($students as $student)
                <tr x-data="window.__controller.dataTableController({{ $student->id }})">
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        @isset($student->imajiAcademy->title)
                            <div>{{ $student->imajiAcademy->title }}</div>
                        @endisset
                    </td>
                    <td>
                        @php($iaff=[])
                        @php($iafp=[])
                        @forelse($student->featureStudents as $ias)
                            <div>{{ $ias->imajiAcademyFeature->feature->title }}</div>
                            @php($iaff[$ias->iaf_id]=0)
                            @php($iafp[$ias->iaf_id]=0)
                        @empty
                            Tanpa fitur
                        @endforelse
                    </td>
                    <td>
                        @foreach($student->featureActivityPresences as $fap)
                            @isset($iaff[$fap->featureActivity->iaf_id])
                            @php($iaff[$fap->featureActivity->iaf_id]+=1)
                            @if($fap->presence_status_id==1)
                                @php($iafp[$fap->featureActivity->iaf_id]+=1)
                            @endif
                            @endisset
                        @endforeach
                        @foreach($iaff as $index=>$a)
                            <div>
                                {{$iafp[$index]}}/{{$a}}
                            </div>
                        @endforeach
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.student.edit',$student->id) }}" class="mr-1 btn btn-success">
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
