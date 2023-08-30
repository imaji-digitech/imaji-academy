<div>
    <x-data-table :data="$data" :model="$teachers">
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
                <th><a wire:click.prevent="sortBy('email')" role="button" href="#">
                        email
                        @include('components.sort-icon', ['field' => 'email'])
                    </a></th>
                <th>
                    Imaji Academy
                </th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($teachers as $teacher)
                <tr x-data="window.__controller.dataTableController({{ $teacher->id }})">
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>
                        @foreach($teacher->featureTeachers as $ias)
                            {{ $ias->imajiAcademyFeature->imajiAcademy->title }} - {{ $ias->imajiAcademyFeature->feature->title }}
                            <br>
                        @endforeach
                    </td>
{{--                    <td>{{ $teacher->created_at->format('d M Y H:i') }}</td>--}}
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.teacher.edit',$teacher->id) }}" class="mr-3 btn btn-primary">
                            <i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem" href="#" class="btn btn-danger">
                            <i class="fa fa-16px fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
