{{-- add permission --}}
{{ html()->form('POST', route('users.edit.permission'))->class('form-add-perm')->open() }}
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon form-button button-add-perm">
            <span class="glyphicon glyphicon-plus-sign add-input"></span>
        </span>
        {{ html()->select('permissions', $permission_values, null)->class('form-control permission-select') }}
    </div>
    <span class="text-danger">{{ $errors->first('permissions') }}</span>
    {{ html()->hidden('id', $user->id) }}
    {{ html()->hidden('operation', 1) }}
</div>
@if(! $user->exists)
    <div class="form-group">
        <span class="text-danger"><h5>You need to create the user first.</h5></span>
    </div>
@endif
{{ html()->form()->close() }}

{{-- remove permission --}}
@if($presenter->permissions)
    @foreach($presenter->permissions_obj as $permission)
        {{ html()->form('POST', route('users.edit.permission'))->name($permission->permission)->open() }}
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon form-button button-del-perm" name="{{ $permission->permission }}">
                    <span class="glyphicon glyphicon-minus-sign add-input"></span>
                </span>
                {{ html()->text('permission_desc', $permission->name)->class('form-control') }}
                {{ html()->hidden('permissions', $permission->permission) }}
                {{ html()->hidden('id', $user->id) }}
                {{ html()->hidden('operation', 0) }}
            </div>
        </div>
        {{ html()->form()->close() }}
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
