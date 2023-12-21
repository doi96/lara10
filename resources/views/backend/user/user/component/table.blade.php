<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th class="text-center">Avatar</th>
            <th class="text-center">User Informations</th>
            <th class="text-center">Address</th>
            <th class="text-center">Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($users) && is_object($users))
            @foreach ($users as $user)
            <tr>
                <td>
                    <input type="checkbox" value="{{ $user->id }}" class="input-checkbox checkBoxItem">
                </td>
                <td>
                    <img src="{{ asset('backend/img/a1.jpg') }}" class="img-square img-lg">
                </td>
                <td>
                    <div class="info-item name"><strong>Full name:</strong> {{ $user->name }}</div>
                    <div class="info-item email"><strong>Email:</strong> {{ $user->email }}</div>
                    <div class="info-item name"><strong>Phone:</strong> {{ $user->phone }}</div>
                </td>
                <td> 
                    <div class="address-item address"><strong>Street:</strong> {{ $user->address }}</div>
                    <div class="address-item province"><strong>Province / City:</strong></div>
                    <div class="address-item district"><strong>District:</strong></div>  
                    <div class="address-item ward"><strong>Ward:</strong></div>   
                </td>
                <td class="text-center js-switch-{{ $user->id }}"> 
                    <input type="checkbox" value="{{ $user->publish }}" 
                    class="js-switch status" 
                    data-field='publish' 
                    data-model="User"  
                    data-modelId="{{ $user->id }}"
                    {{ ($user->publish == 1) ? 'checked' : '' }}/>
                </td>
                <td class="text-center"> 
                    <a href='{{ route('user.edit',$user->id) }}' type="button" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href='{{ route('user.delete',$user->id) }}' type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
@if (isset($users) && is_object($users))
{{ $users->links('pagination::bootstrap-4')}}
@endif