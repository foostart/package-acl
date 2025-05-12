{{-- add permission --}}
<!-- FORM OPEN -->
@include('package-category::admin.partials.form_open', [
    'method' => 'POST',
    'action' => route('users.edit.permission'),
    'class' => 'form-add-perm'
])

<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon form-button button-add-perm">
            <span class="glyphicon glyphicon-plus-sign add-input"></span>
        </span>
        {{ html()->select('permissions', $permission_values, null)->class('form-control permission-select') }}
    </div>
    <span class="text-danger">{{ $errors->first('permissions') }}</span>
    @include('package-category::admin.partials.input_text', [
        'hidden' => true,
        'name'   => 'id',
        'id'     => 'id',
        'value'  => $user->id
    ])

    @include('package-category::admin.partials.input_text', [
        'hidden' => true,
        'name'   => 'operation',
        'id'     => 'operation',
        'value'  => 1
    ])

</div>
@if(! $user->exists)
    <div class="form-group">
        <span class="text-danger"><h5>You need to create the user first.</h5></span>
    </div>
@endif
<!-- FORM CLOSE -->
@include('package-category::admin.partials.form_close')

{{-- remove permission --}}
@if($presenter->permissions)
    @foreach($presenter->permissions_obj as $permission)
        <!-- FORM OPEN -->
        @include('package-category::admin.partials.form_open', [
            'method' => 'POST',
            'action' => route('users.edit.permission'),
            'name' => $permission->permission
        ])

        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon form-button button-del-perm" name="{{ $permission->permission }}">
                    <span class="glyphicon glyphicon-minus-sign add-input"></span>
                </span>
                @include('package-category::admin.partials.input_text', [
                    'name'  => 'permission_desc',
                    'id'    => 'permission_desc',
                    'value' => $permission->name,
                    'class' => 'form-control'
                ])

                @include('package-category::admin.partials.input_text', [
                    'hidden' => true,
                    'name'   => 'permissions',
                    'id'     => 'permissions',
                    'value'  => $permission->permission
                ])

                @include('package-category::admin.partials.input_text', [
                    'hidden' => true,
                    'name'   => 'id',
                    'id'     => 'id',
                    'value'  => $user->id
                ])

                @include('package-category::admin.partials.input_text', [
                    'hidden' => true,
                    'name'   => 'operation',
                    'id'     => 'operation',
                    'value'  => 0
                ])

            </div>
        </div>
        <!-- FORM CLOSE -->
        @include('package-category::admin.partials.form_close')
    @endforeach
@elseif($user->exists)
    <span class="text-warning"><h5>There is no permission associated to the user.</h5></span>
@endif

@section('footer_scripts')
    @parent
    <script>
        $(".button-add-perm").click(function () {
            @if($user->exists)
            $('.form-add-perm').submit();
            @endif
        });

        $(".button-del-perm").click(function () {
            var _name = $(this).attr('name');
            $('form[name="' + _name + '"]').submit();
        });
    </script>
@stop
