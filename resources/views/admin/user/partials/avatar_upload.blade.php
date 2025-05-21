<div class="row">
    <div class="col-md-6">
        <h4><i class="fa fa-picture-o"></i>{!! trans($plang_admin.'.labels.avatar') !!}</h4>
        <div class="profile-avatar">
            <img src="{{ $user_profile->presenter()->avatar }}">
        </div>
    </div>
    <div class="col-md-6">
        <!-- FORM OPEN -->
        @include('package-category::admin.partials.form_open', [
            'method' => 'POST',
            'action' => route('users.profile.changeavatar'),
        ])


            @include('package-category::admin.partials.label', [
                'name' => 'avatar',
                'label' => $user_profile->avatar ? trans($plang_admin.'.labels.update-avt') . ':' : trans($plang_admin.'.labels.change-avt')
            ])
	        <div class="form-group">

                @include('package-category::admin.partials.input_image', [
                    'name' => 'avatar',
                    'class' => 'form-control'
                ])
	            <span class="text-danger">{{ $errors->first('avatar') }}</span>
	        </div>
        @include('package-category::admin.partials.input_text', [
            'hidden' => true,
            'name'   => 'user_id',
            'id'     => 'user_id',
            'value'  => $user_profile->user_id
        ])

        @include('package-category::admin.partials.input_text', [
            'hidden' => true,
            'name'   => 'user_profile_id',
            'id'     => 'user_profile_id',
            'value'  => $user_profile->id
        ])

        <div class="form-group">
                @include('package-category::admin.partials.btn_submit', [
                     'label' => trans($plang_admin.'.buttons.update-avatar'),
                     'class' => 'btn btn-info'
                 ])

            </div>
        <!-- FORM CLOSE -->
        @include('package-category::admin.partials.form_close')
    </div>
</div>
