<div class="filter-wrapper">
    <div class="uk-flex uk-flex-middle uk-flex-space-between">
        <div class="perpage">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <select name="perpage" class="form-control input-sm perpage filter mr10">
                    @for ($i = 20; $i <= 200; $i+=20)   
                        <option value="{{ $i }}">{{ $i }} Records</option>           
                    @endfor
                </select>
            </div>
        </div>
        <div class="action">
            <div class="uk-flex uk-flex-middle">
                <select name="user_catalogue_id" class="form-control mr10">
                    <option value="0" selected='selected'>Choose Users Group</option>
                    <option value="1">Admin</option>
                </select>
                <div class="uk-search uk-flex uk-flex-middle mr10">
                    <div class="input-group">
                        <input type="text" name="keyword" value="" placeholder="Enter value to search..." class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" name="search" value="search" class="btn btn-success mb0 btn-sm">
                                Search
                            </button>
                        </span>
                    </div>
                </div>
                <a href=" {{ route('user.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a>
            </div>
        </div>
    </div>
</div>