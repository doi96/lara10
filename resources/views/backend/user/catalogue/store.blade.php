@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['create']['title']])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = ($config['method'] == 'create') ? route('user.store') : route('user.update',$user->id);
@endphp
<form action="{{ $url }}" method="POST" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel-head">
                    <div class="panel-title">General Informations</div>
                    <div class="panel-description">Enter General Informations of User</div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Email <span class="text-danger">(*)</span></label>
                                    <input type="text" name="email" value="{{  old('email', ($user->email) ?? '') }}" class="form-control" placeholder="Email" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Full Name <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" value="{{  old('name', ($user->name) ?? '') }}" class="form-control" placeholder="Full Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        @php
                            $userCatelogue = [
                                '>> Select Group User Permissions <<',
                                'Admin',
                                'Supplier',
                                'Manager',
                                'Cashier',
                                'Accountant',
                                'Collaborators'
                            ];
                        @endphp
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Group Permission User<span class="text-danger">(*)</span></label>
                                    <select name="user_catalogue_id" class="form-control setupSelect2">
                                        @foreach ($userCatelogue as $key => $item)
                                            <option {{ $key == old('user_catalogue_id', (isset($user->user_catalogue_id)) ? $user->user_catalogue_id : '') ? 'selected' : ''}} value ={{ $key }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Day of Birth</label>
                                    <input type="date" name="birthday" value="{{  old('birthday', (isset($user->birthday)) ? date ('Y-m-d', strtotime($user->birthday)) : '') }}" class="form-control" placeholder="Day of Birth" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        @if ($config['method'] == 'create')
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Password <span class="text-danger">(*)</span></label>
                                    <input type="password" name="password" value="" class="form-control" placeholder="Password" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Confirm Password <span class="text-danger">(*)</span></label>
                                    <input type="password" name="re_password" value="" class="form-control" placeholder="Confirm Password" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Avatar</label>
                                    <input type="text" name="image" value="{{  old('image', ($user->image) ?? '') }}" class="form-control input-image" placeholder="Image" autocomplete="off" data-upload="Images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-4">
                <div class="panel-head">
                    <div class="panel-title">Contact Informations</div>
                    <div class="panel-description">Enter Contact Informations of User</div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Province / City</label>
                                    <select name="province_id" id="" class="form-control setupSelect2 province location" data-target="districts">
                                        <option value="0">Select Province or City</option>
                                        @if (isset($provinces))
                                            @foreach ($provinces as $province)
                                            <option @if(old('province_id') == $province->code) selected @endif value="{{ $province->code }}">{{ $province->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">District</label>
                                    <select name="district_id" id="" class="form-control districts setupSelect2 location" data-target="wards">
                                        <option value="0">Select District</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ward</label>
                                    <select name="ward_id" id="" class="form-control setupSelect2 wards">
                                        <option value="0">Select Ward</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Address</label>
                                    <input type="text" name="address" value="{{  old('address', ($user->address) ?? '') }}" class="form-control" placeholder="Address" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Phone</label>
                                    <input type="text" name="phone" value="{{  old('phone', ($user->phone) ?? '') }}" class="form-control" placeholder="Phone Number" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Note</label>
                                    <textarea type="text" name="description" class="form-control" placeholder="Take note" autocomplete="off">{{  old('description', ($user->description) ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn-primary" type="submit" name="send" value="send">Add User</button>
        </div>
    </div>
</form>

<script>
    var province_id = '{{ (isset($user->province_id)) ? $user->province_id : old('province_id') }}'
    var district_id = '{{ (isset($user->district_id)) ? $user->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($user->ward_id)) ? $user->ward_id : old('ward_id') }}'
</script>