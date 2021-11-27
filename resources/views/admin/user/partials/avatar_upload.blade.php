<div class="row">
    <div class="col-md-6">
        <h4><i class="fa fa-picture-o"></i>{!! trans($plang_admin.'.labels.avatar') !!}</h4>
        <div class="profile-avatar">
            <img src="{!! $user_profile->presenter()->avatar !!}">
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::open(['route' => 'users.profile.changeavatar', 'method' => 'POST', 'files' => true]) !!}
        {!! Form::label('avatar',$user_profile->avatar ? trans($plang_admin.'.labels.update-avt').':' : trans($plang_admin.'.labels.change-avt').':') !!}
        <div class="form-group">
            {!! Form::file('avatar', ['class' => 'form-control']) !!}
            <span class="text-danger">{!! $errors->first('avatar') !!}</span>
        </div>
        {!! Form::hidden('user_id', $user_profile->user_id) !!}
        {!! Form::hidden('user_profile_id', $user_profile->id) !!}
        <div class="form-group">
            {!! Form::submit(trans($plang_admin.'.buttons.update-avatar'), ['class' => 'btn btn-info']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>