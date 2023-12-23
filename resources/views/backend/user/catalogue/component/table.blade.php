<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th class="text-center">Name's Group</th>
            <th class="text-center">Numbers</th>
            <th class="text-center">Descriptions</th>
            <th class="text-center">Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($userCatalogues) && is_object($userCatalogues))
            @foreach ($userCatalogues as $userCatalogue)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $userCatalogue->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    <div class="info-item name">{{ $userCatalogue->name }}</div>
                </td>
                <td class="text-center">
                    {{ $userCatalogue->users_count }} <i class="fa fa-user">
                </td>
                <td>
                    {{ $userCatalogue->description }}
                </td>
                <td class="text-center js-switch-{{ $userCatalogue->id }}"> 
                    <input type="checkbox" value="{{ $userCatalogue->publish }}" 
                    class="js-switch status" 
                    data-field='publish' 
                    data-model="UserCatalogue"  
                    data-modelId="{{ $userCatalogue->id }}"
                    {{ ($userCatalogue->publish == 2) ? 'checked' : '' }}/>
                </td>
                <td class="text-center"> 
                    <a href='{{ route('user.catalogue.edit',$userCatalogue->id) }}' type="button" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href='{{ route('user.catalogue.delete',$userCatalogue->id) }}' type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if (isset($userCatalogues) && is_object($userCatalogues))
{{ $userCatalogues->links('pagination::bootstrap-4')}}
@endif