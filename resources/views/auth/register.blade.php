<div class="panel panel-default">
    <div class="panel-title">
        Регистрация
        <ul class="panel-tools">
            <li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
        </ul>
    </div>
    <div class="panel-body account" style="display: none;">
        {!! Form::open(['data-remote-account','method'=>'post','url'=>'auth/register']) !!}
        <div class="group">
            <div id="avatar-upload"></div>
        </div>
        <div class="group">
            <i class="fa-position fa fa-user"></i>
            {!! Form::text('name',null,['class' => 'form-postition form-control','placeholder'=>'Име']) !!}
            <i data-show-error="name" class="fa fa-warning pop-warning"></i>
        </div>
        <div class="group">
            <i class="fa-position fa fa-envelope-o"></i>
            {!! Form::text('email',null,['class' => 'form-postition form-control','placeholder' => 'Имейл']) !!}
            <i data-show-error="email" class="fa fa-warning pop-warning"></i>
        </div>
        <div class="group">
            <i class="fa-position fa fa-key "></i>
            {!! Form::password('password',['class' => 'form-postition form-control','placeholder' => 'Парола']) !!}
            <i data-show-error="password" class="fa fa-warning pop-warning"></i>
        </div>

        <div class="group">
            <i class="fa-position fa fa-key"></i>
            {!! Form::password('password_confirmation',['class' => 'form-postition form-control','placeholder' =>
            'Потвърди парола']) !!}
        </div>
        <br>

        <div class="form-group">
            <select name="categories[]" id="multiple-optgroups" multiple="multiple">
                @foreach($root_categories as $root)
                    <optgroup label="{{ $root->name }}">
                        @foreach($categories as $category)
                            @if($root->id == $category->parent_id)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="role">

                @foreach($roles as $role)
                    @if($role->name == 'Base')
                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                    @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endif
                @endforeach

            </select>
        </div>
        <button id="start-upload" type="submit" class="btn btn-light btn-pos">Регистрирай</button>
        {!! Form::close() !!}
    </div>
</div>






