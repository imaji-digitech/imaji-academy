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
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($students as $student)
                <tr x-data="window.__controller.dataTableController({{ $student->id }})">
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        @isset($student->featureStudents[0]->imajiAcademyFeature->imajiAcademy->title)
                            {{$student->featureStudents[0]->imajiAcademyFeature->imajiAcademy->title}}
                        @endisset
                        {{--                        @forelse($student->featureStudents as $ias)--}}
                        {{--                            {{ $ias->imajiAcademyFeature->imajiAcademy->title }}--}}
                        {{--                            --}}
                        {{--                        @empty--}}
                        {{--                            --}}
                        {{--                        @endforelse--}}
                    </td>
                    <td>
                        @foreach($student->featureStudents as $ias)
                            {{ $ias->imajiAcademyFeature->feature->title }}
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($student->featureStudents as $ias)
                            {{ $ias->imajiAcademyFeature->feature->title }}
                            <br>
                        @endforeach
                    </td>
                    {{--                    <td>{{ $student->created_at->format('d M Y H:i') }}</td>--}}
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="student/edit/{{ $student->id }}" class="mr-3"><i
                                class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#"><i
                                class="fa fa-16px fa-trash text-red-500"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
