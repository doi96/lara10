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
    $url = ($config['method'] == 'create') ? route('user.catalogue.store') : route('user.catalogue.update',$userCatalogue->id);
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
                                    <label for="" class="control-label text-left">Full Name <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" value="{{  old('name', ($userCatalogue->name) ?? '') }}" class="form-control" placeholder="Full Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Description </label>
                                    <textarea type="text" name="description" class="form-control">{{  old('name', ($userCatalogue->description) ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn-primary" type="submit" name="send" value="send">Save</button>
        </div>
    </div>
</form>
