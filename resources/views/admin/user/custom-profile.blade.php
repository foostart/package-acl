<h4><i class="fa fa-magic"></i>{!! trans($plang_admin.'.labels.custom-fields').':' !!}</h4>

{{-- add fields --}}
{{ html()->form('POST', route('users.profile.addfield'))->class('form-add-profile-field')->open() }}
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon form-button button-add-profile-field"><span
                    class="glyphicon glyphicon-plus-sign add-input"></span></span>
        {{ html()->text('description')->class('form-control')->placeholder('Custom field name') }}
        {{ html()->hidden('user_id', $user_profile->user_id) }}
    </div>
</div>
{{ html()->form()->close() }}

{{-- delete fields --}}
@foreach($custom_profile->getAllTypesWithValues() as $profile_data)
    {{ html()->form('POST', route('users.profile.deletefield'))->name($profile_data->id)->open() }}
    <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon form-button button-del-profile-field" name="{{ $profile_data->id }}"><span
                    class="glyphicon glyphicon-minus-sign add-input"></span></span>
            {{ html()->text('profile_description', $profile_data->description)->class('form-control')->readonly() }}
            {{ html()->hidden('id', $profile_data->id) }}
            {{ html()->hidden('user_id', $user_profile->user_id) }}
        </div>
    </div>
    {{ html()->form()->close() }}
@endforeach

@section('footer_scripts')
    @parent
    <script>
        $(".button-add-profile-field").click(function () {
            $('.form-add-profile-field').submit();
        });
        $(".button-del-profile-field").click(function () {
            if (!confirm('Are you sure to delete this field?')) return;

            // submit the form with the same name
            name = $(this).attr('name');
            $('form[name=' + name + ']').submit();
        });
    </script>
@stop
