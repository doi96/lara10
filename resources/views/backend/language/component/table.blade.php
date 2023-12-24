<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th>Language Name</th>
            <th>Canonical</th>
            <th>Descriptions</th>
            <th class="text-center">Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($languages) && is_object($languages))
            @foreach ($languages as $language)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $language->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    <div class="info-item name">{{ $language->name }}</div>
                </td>
                <td class="text-center">
                    {{ $language->canonical }} <i class="fa fa-bookmark">
                </td>
                <td>
                    {{ $language->description }}
                </td>
                <td class="text-center js-switch-{{ $language->id }}"> 
                    <input type="checkbox" value="{{ $language->publish }}" 
                    class="js-switch status" 
                    data-field='publish' 
                    data-model="Language"  
                    data-modelId="{{ $language->id }}"
                    {{ ($language->publish == 2) ? 'checked' : '' }}/>
                </td>
                <td class="text-center"> 
                    <a href='{{ route('language.edit',$language->id) }}' type="button" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href='{{ route('language.delete',$language->id) }}' type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if (isset($languages) && is_object($languages))
{{ $languages->links('pagination::bootstrap-4')}}
@endif