{{-- add group --}}
<!-- FORM OPEN -->
@include('package-category::admin.partials.form_open', [
    'method' => 'POST',
    'action' => route('users.groups.add'),
    'class' => 'form-add-group',
])

<div class="form-group">
    <div class="input-group">
            <span class="input-group-addon form-button button-add-group">
                <span class="glyphicon glyphicon-plus-sign add-input"></span>
            </span>
        {{ html()->select('group_id', $group_values)->class('form-control') }}
        @include('package-category::admin.partials.input_text', [
            'hidden' => true,
            'name'   => 'id',
            'id'     => 'id',
            'value'  => $user->id
        ])

    </div>
    <span class="text-danger">{{ $errors->first('name') }}</span>
</div>

@include('package-category::admin.partials.input_text', [
    'hidden' => true,
    'name'   => 'id',
    'id'     => 'id',
    'value'  => $user->id
])


@if (! $user->exists)
    <div class="form-group">
        <span class="text-danger"><h5>You need to create the user first.</h5></span>
    </div>
@endif
<!-- FORM CLOSE -->
@include('package-category::admin.partials.form_close')

{{-- delete group --}}
@if (! $user->groups->isEmpty())
    @foreach ($user->groups as $group)
        <!-- FORM OPEN -->
        @include('package-category::admin.partials.form_open', [
            'method' => 'POST',
            'action' => route('users.groups.delete'),
            'name' => 'group-' . $group->id,
        ])

        <div class="form-group">
            <div class="input-group">
                    <span class="input-group-addon form-button button-del-group" name="group-{{ $group->id }}">
                        <span class="glyphicon glyphicon-minus-sign add-input"></span>
                    </span>
                @include('package-category::admin.partials.input_text', [
                    'name'      => 'group_name',
                    'id'        => 'group_name',
                    'value'     => $group->name,
                    'class'     => 'form-control',
                    'readonly'  => true
                ])

                @include('package-category::admin.partials.input_text', [
                    'hidden' => true,
                    'name'   => 'id',
                    'id'     => 'id',
                    'value'  => $user->id
                ])

                @include('package-category::admin.partials.input_text', [
                    'hidden' => true,
                    'name'   => 'group_id',
                    'id'     => 'group_id',
                    'value'  => $group->id
                ])

            </div>
        </div>
        <!-- FORM CLOSE -->
        @include('package-category::admin.partials.form_close')
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
