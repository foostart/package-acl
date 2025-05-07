<div class="row">
    <div class="col-md-6">
        <h4><i class="fa fa-picture-o"></i>{!! trans($plang_admin.'.labels.avatar') !!}</h4>
        <div class="profile-avatar">
            <img src="{{ $user_profile->presenter()->avatar }}">
        </div>
    </div>
    <div class="col-md-6">
        {{ html()->form('POST', route('users.profile.changeselfavatar'))->files()->open() }}
        {{ html()->label($user_profile->avatar ? trans($plang_admin.'.labels.update-avt') . ':' : trans($plang_admin.'.labels.change-avt') . ':')->for('avatar') }}
        <div class="form-group">
            {{ html()->file('avatar')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('avatar') }}</span>
        </div>
        {{ html()->hidden('user_id', $user_profile->user_id) }}
        {{ html()->hidden('user_profile_id', $user_profile->id) }}
        <div class="form-group">
            {{ html()->submit(trans($plang_admin.'.buttons.update-avatar'))->class('btn btn-info') }}
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
