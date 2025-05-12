{!! Form::open(["route" => "groups.edit.permission","role"=>"form", 'class' => 'form-add-perm']) !!}
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon form-button button-add-perm"><span
                class="glyphicon glyphicon-plus-sign add-input"></span></span>
        {!! Form::select('permissions', $permission_values, '', ["class"=>"form-control permission-select"]) !!}
    </div>
    <span class="text-danger">{!! $errors->first('permissions') !!}</span>
    {!! Form::hidden('id', $group->id) !!}
    {{-- add permission operation --}}
    {!! Form::hidden('operation', 1) !!}
</div>
<div class="form-group">
    @if(! $group->exists)
        <span class="text-danger"><h5>You need to create a group first.</h5></span>
    @endif
</div>
{!! Form::close() !!}

                    @if( $presenter->permissions )
                        @foreach($presenter->permissions_obj as $permission)
                            @if($permission)
                                <!-- FORM OPEN -->
                                @include('package-category::admin.partials.form_open', [
                                    'method' => 'GET',
                                    'action' => route('groups.edit.permission'),
                                    'class'  => 'form-add-perm',
                                    'name'   => $permission->permission,
                                ])
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon form-button button-del-perm" name="{{ $permission->permission }}"><span class="glyphicon glyphicon-minus-sign add-input"></span></span>
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
                                                'value'  => $group->id
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
                            @endif
                        @endforeach
                    @elseif($group->exists)
                        <span class="text-warning"><h5>There is no permission associated to the group.</h5></span>
                    @endif



@section('footer_scripts')
    @parent
    <script>
        $(".button-add-perm").click(function () {
            <?php if($group->exists): ?>
            $('.form-add-perm').submit();
            <?php endif; ?>
        });
        $(".button-del-perm").click(function () {
            name = $(this).attr('name');
            $('form[name=' + name + ']').submit();
        });
    </script>
@stop
