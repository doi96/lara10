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

<form action="{{ route('user.store') }}" method="POST" class="box">
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
                                    <input type="text" name="email" value="{{  old('email') }}" class="form-control" placeholder="Email" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Full Name <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" value="{{  old('name') }}" class="form-control" placeholder="Full Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Group Permission User<span class="text-danger">(*)</span></label>
                                    <select name="user_catalogue_id" class="form-control setupSelect2" id="">
                                        <option value="0">Select Group Permission User</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Collaborators</option>
                                        {{-- @foreach ($userCatalogues as $userCatalogue)
                                            <option value="{{ $userCatalogue->id }}">{{ $userCatalogue->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Day of Birth</label>
                                    <input type="date" name="birthday" value="{{  old('birthday') }}" class="form-control" placeholder="Day of Birth" autocomplete="off">
                                </div>
                            </div>
                        </div>
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
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Avatar</label>
                                    <input type="text" name="image" value="{{  old('image') }}" class="form-control input-image" placeholder="Image" autocomplete="off" data-upload="Images">
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
                                            <option value="{{ $province->code }}">{{ $province->name }}</option>
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
                                    <input type="text" name="address" value="{{  old('address') }}" class="form-control" placeholder="Address" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Phone</label>
                                    <input type="text" name="phone" value="{{  old('phone') }}" class="form-control" placeholder="Phone Number" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Note</label>
                                    <textarea type="text" name="description" value="{{  old('description') }}" class="form-control" placeholder="Take note" autocomplete="off">{{ old('desciption') }}</textarea>
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