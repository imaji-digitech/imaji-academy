<div>
    <x-data-table :data="$data" :model="$features">
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
                <th>Imaji Academy</th>
                <th>Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($features as $feature)
                <tr x-data="window.__controller.dataTableController({{ $feature->id }})">
                    <td>{{ $feature->id }}</td>
                    <td>{{ $feature->title }}</td>
                    <td>{{ $feature->code }}</td>
                    <td>
                        @foreach($feature->imajiAcademyFeatures as $iaf)
                            <div>{{$iaf->imajiAcademy->title}}</div>
                        @endforeach
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.feature.edit',$feature->id) }}" class="mr-3 btn btn-success">
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
