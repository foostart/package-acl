{{-- add group --}}
{{ html()->form('POST', route('users.groups.add'))->class('form-add-group')->open() }}
<div class="form-group">
    <div class="input-group">
            <span class="input-group-addon form-button button-add-group">
                <span class="glyphicon glyphicon-plus-sign add-input"></span>
            </span>
        {{ html()->select('group_id', $group_values)->class('form-control') }}
        {{ html()->hidden('id', $user->id) }}
    </div>
    <span class="text-danger">{{ $errors->first('name') }}</span>
</div>

{{ html()->hidden('id', $user->id) }}

@if (! $user->exists)
    <div class="form-group">
        <span class="text-danger"><h5>You need to create the user first.</h5></span>
    </div>
@endif
{{ html()->form()->close() }}

{{-- delete group --}}
@if (! $user->groups->isEmpty())
    @foreach ($user->groups as $group)
        {{ html()->form('POST', route('users.groups.delete'))->name('group-' . $group->id)->open() }}
        <div class="form-group">
            <div class="input-group">
                    <span class="input-group-addon form-button button-del-group" name="group-{{ $group->id }}">
                        <span class="glyphicon glyphicon-minus-sign add-input"></span>
                    </span>
                {{ html()->text('group_name', $group->name)->class('form-control')->attribute('readonly', true) }}
                {{ html()->hidden('id', $user->id) }}
                {{ html()->hidden('group_id', $group->id) }}
            </div>
        </div>
        {{ html()->form()->close() }}
    @endforeach
@elseif ($user->exists)
    <span class="text-warning"><h5>There are no groups associated with the user.</h5></span>
@endif

@section('footer_scripts')
    @parent
    <script>
        $(".button-add-group").click(function () {
            @if ($user->exists)
                $('.form-add-group').submit();
            @else
                alert("You need to create the user first.");
            @endif
        });

        $(".button-del-group").click(function () {
            var _name = $(this).attr('name');
            $('form[name="' + _name + '"]').submit();
        });
    </script>
@stop
