{{-- Form mở --}}
{{ html()->modelForm($user_profile, 'POST', route('users.profile.edit'))->open() }}

<div class="row">
    <div class="col-md-6 col-xs-12">
        {{-- Password --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.new-password'))->for('password') }}
            {{ html()->password('password')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('password') }}</span>
        </div>

        {{-- Password Confirmation --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.confirm-password'))->for('password_confirmation') }}
            {{ html()->password('password_confirmation')->class('form-control') }}
        </div>

        {{-- Code --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.code'))->for('code') }}
            {{ html()->text('code')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('code') }}</span>
        </div>

        {{-- First name --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.first_name'))->for('first_name') }}
            {{ html()->text('first_name')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('first_name') }}</span>
        </div>

        {{-- Last name --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.last_name'))->for('last_name') }}
            {{ html()->text('last_name')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('last_name') }}</span>
        </div>

        {{-- Phone --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.phone'))->for('phone') }}
            {{ html()->text('phone')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('phone') }}</span>
        </div>

        {{-- State --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.state'))->for('state') }}
            {{ html()->text('state')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('state') }}</span>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        {{-- VAT --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.vat'))->for('var') }}
            {{ html()->text('var')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('vat') }}</span>
        </div>

        {{-- City --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.city'))->for('city') }}
            {{ html()->text('city')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('city') }}</span>
        </div>

        {{-- Country --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.country'))->for('country') }}
            {{ html()->text('country')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('country') }}</span>
        </div>

        {{-- Sex --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.sex'))->for('sex') }}
            {{ html()->select('sex', trans($plang_admin.'.sex'))->class('form-control') }}
            <span class="text-danger">{{ $errors->first('sex') }}</span>
        </div>

        {{-- Device Token --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.device_token'))->for('device_token') }}
            {{ html()->text('device_token')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('device_token') }}</span>
        </div>

        {{-- Level --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.level'))->for('level_id') }}
            {{ html()->select('level_id', $pluck_select_category_level)->class('form-control') }}
            <span class="text-danger">{{ $errors->first('level_id') }}</span>
        </div>

        {{-- Category --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.category'))->for('category_id') }}
            {{ html()->select('category_id', $pluck_select_category_department)->class('form-control') }}
            <span class="text-danger">{{ $errors->first('category_id') }}</span>
        </div>

        {{-- Address --}}
        <div class="form-group">
            {{ html()->label(trans($plang_admin.'.labels.address'))->for('address') }}
            {{ html()->text('address')->class('form-control') }}
            <span class="text-danger">{{ $errors->first('address') }}</span>
        </div>

        {{-- Custom Profile Fields --}}
        @foreach($custom_profile->getAllTypesWithValues() as $profile_data)
            <div class="form-group">
                {{ html()->label($profile_data->description) }}
                {{ html()->text("custom_profile_{$profile_data->id}", $profile_data->value)->class('form-control') }}
            </div>
        @endforeach

        {{-- Hidden fields + Submit --}}
        {{ html()->hidden('user_id', $user_profile->user_id) }}
        {{ html()->hidden('id', $user_profile->id) }}
        {{ html()->submit('Save')->class('btn btn-info pull-right margin-bottom-30') }}
    </div>
</div>

{{-- Form đóng --}}
{{ html()->form()->close() }}
