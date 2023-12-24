@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['delete']['title']])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('language.destroy',$language->id) }}" method="POST" class="box">
    @csrf
    @method('DELETE')
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
                                    <label for="" class="control-label text-left">Language Name <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" value="{{  old('name', ($language->name) ?? '') }}" class="form-control" placeholder="Language Name" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Description <span class="text-danger">(*)</span></label>
                                    <input type="text" name="description" value="{{  old('description', ($language->description) ?? '') }}" class="form-control" placeholder="Full Name" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-right mb15">
            <button class="btn-danger" type="submit" name="send" value="send">Delete Group User</button>
        </div>
    </div>
</form>
