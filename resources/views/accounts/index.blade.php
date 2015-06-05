@extends('app')

@section('content')
    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Акаунти</h1>
        <ol class="breadcrumb">
            <li class="active">Форма достъпна само за администратори - за добвяне и коригиране на акаунти</li>
        </ol>
    </div>
    <!-- End Page Header -->
    
<div class="col-md-12">
    <div class="panel panel-default panel-account">

        <div class="panel-title">
            Служители
        </div>

        <div class="panel-body">

            <table class="table">
                <thead>
                <tr>
                    <td>Снимка</td>
                    <td>Име</td>
                    <td>Длъжност</td>
                    <td>Време</td>
                    <td>Права</td>
                    <td>Отчет</td>
                    <td>История</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)

                        <tr class="info">
                            <td ><div class="list-image"><img src="/avatar/{{\Hashids::encode($user->id,rand(0,100))}}" alt="img" class="img"></div></td>
                            <td>{{ $user->name }}</td>
                            <td><select name="categories[]" class="select-account-position" multiple="multiple">
                                    @foreach($root_categories as $root)
                                        <optgroup label="{{ $root->name }}">
                                            @foreach($categories as $category)
                                                @if($root->id == $category->parent_id)
                                                    @if( $user->categoryServices->contains($category->id ) )
                                                        <option value="{{ $category->id }}" selected >{{ $category->name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}"  >{{ $category->name }}</option>
                                                    @endif

                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select></td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        {!! Form::open(['data-remote','method'=>'POST','url'=>'/accounts/role']) !!}
                                        {!! Form::text('user_id',\Hashids::encode($user->id,rand(0,100)),['style'=>'display:none']) !!}

                                        <select class="selectpicker">

                                            @foreach($roles as $role)

                                                @if($user->roles[0]->pivot->role_id == $role->id)
                                                    <option selected value="{{\Hashids::encode($role->id,rand(0,100)) }}" >{{ $role->name }}</option>
                                                @else
                                                    <option value="{{\Hashids::encode($role->id,rand(0,100)) }}">{{ $role->name }}</option>
                                                @endif

                                            @endforeach

                                        </select>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </td>
                            <td>Credit Card</td>
                            <td>Бутон</td>
                        </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="create-account-table">
    <div class="col-md-12 col-lg-6 registration-form">
        @include('auth.register')
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select-account-position').multiselect({
                enableFiltering: true,
                enableClickableOptGroups: true,
                buttonWidth: '340px'
            });
            
        });
    </script>
@endsection
