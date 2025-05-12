<h4><i class="fa fa-magic"></i>{!! trans($plang_admin.'.labels.custom-fields').':' !!}</h4>

{{-- add fields --}}
<!-- FORM OPEN -->
@include('package-category::admin.partials.form_open', [
    'method' => 'POST',
    'action' => route('users.profile.addfield'),
    'class' => 'form-add-profile-field',
])
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon form-button button-add-profile-field"><span
                    class="glyphicon glyphicon-plus-sign add-input"></span></span>
        @include('package-category::admin.partials.input_text', [
            'name'        => 'description',
            'id'          => 'description',
            'value'       => null,
            'class'       => 'form-control',
            'placeholder' => 'Custom field name'
        ])

        @include('package-category::admin.partials.input_text', [
            'hidden' => true,
            'name'   => 'user_id',
            'id'     => 'user_id',
            'value'  => $user_profile->user_id
        ])
    </div>
</div>
<!-- FORM CLOSE -->
@include('package-category::admin.partials.form_close')

{{-- delete fields --}}
@foreach($custom_profile->getAllTypesWithValues() as $profile_data)
    <!-- FORM OPEN -->
    @include('package-category::admin.partials.form_open', [
        'method' => 'POST',
        'action' => route('users.profile.deletefield'),
        'name' => $profile_data->id,
    ])

    <div class="form-group">
        <div class="input-group">
        <span class="input-group-addon form-button button-del-profile-field" name="{{ $profile_data->id }}"><span
                    class="glyphicon glyphicon-minus-sign add-input"></span></span>
            @include('package-category::admin.partials.input_text', [
                'name'  => 'profile_description',
                'id'    => 'profile_description',
                'value' => $profile_data->description,
                'class' => 'form-control'
            ])

            @include('package-category::admin.partials.input_text', [
                'hidden' => true,
                'name'   => 'id',
                'id'     => 'id',
                'value'  => $profile_data->id
            ])

            @include('package-category::admin.partials.input_text', [
                'hidden' => true,
                'name'   => 'user_id',
                'id'     => 'user_id',
                'value'  => $user_profile->user_id
            ])

        </div>
    </div>
    <!-- FORM CLOSE -->
    @include('package-category::admin.partials.form_close')
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
