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
                <td>Права</td>
                <td>История</td>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr class="info">
                    <td>
                        <div class="list-image"><img src="/avatar/{{\Hashids::encode($user->id,rand(0,100))}}" alt="img"
                                                     class="img"></div>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>
                        {!! Form::open(['data-employment','method'=>'POST','url'=>'/accounts/employment']) !!}
                        {!! Form::text('user_id',$user->id,['style'=>'display:none']) !!}
                        <select name="categories[]" class="select-account-position" multiple="multiple">
                            @foreach($root_categories as $root)
                                <optgroup label="{{ $root->name }}">
                                    @foreach($categories as $category)
                                        @if($root->id == $category->parent_id)
                                            @if( $user->categoryServices->contains($category->id ) )
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        {!! Form::close() !!}

                    </td>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-8">
                                {!! Form::open(['data-remote','method'=>'POST','url'=>'/accounts/role']) !!}
                                {!! Form::text('user_id',\Hashids::encode($user->id,rand(0,100)),['style'=>'display:none']) !!}

                                <select class="selectpicker">

                                    @foreach($roles as $role)

                                        @if($user->roles[0]->pivot->role_id == $role->id)
                                            <option selected
                                                    value="{{\Hashids::encode($role->id,rand(0,100)) }}">{{ $role->name }}</option>
                                        @else
                                            <option value="{{\Hashids::encode($role->id,rand(0,100)) }}">{{ $role->name }}</option>
                                        @endif

                                    @endforeach

                                </select>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </td>
                    <td>Бутон</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>
<nav class="pagination-users">
    <ul class="pagination">
        <li>
            <a class="prev-page-user" href="javascript:void(0)"><span>«</span></a>
        </li>
        @for ($i = 0; $i < $users->lastpage(); $i++)
            <li><a class="page-users"  data-page="{{ $i+1 }}" href="javascript:void(0)">{{$i + 1}}</a></li>
        @endfor
        <li>
            <a class="next-page-user" href="javascript:void(0)" aria-label="Next"><span>»</span></a>
        </li>
    </ul>
</nav>

<script type="text/javascript">
   $(document).ready(function () {

        $('.select-account-position').multiselect({
            enableFiltering: true,
            enableClickableOptGroups: true,
            maxHeight: 600,
            onChange: function (option, checked, select) {
                user_id = $(option).closest('form').find('input[name="user_id"]').val();
                $.ajax({
                    type: 'POST',
                    url: '/accounts/employment',
                    data: {
                        '_token': Globals._token,
                        'user_id': user_id,
                        'category_service_id': $(option).val(),
                        'bool': checked
                    },
                    success: function (data) {
                        //console.log(data);
                    }
                })
                //$('.flash').empty().append('Акаунтът е обновен!').fadeIn(500).delay(300).fadeOut(500);
            }
        });

        $( ".page-users" ).on( "click", function(){
            $.ajax({
                url: '/accounts/accounts/?page='+$(this).data('page'),
                type: "GET", // not POST, laravel won't allow it
                success: function(data){
                    $data = $(data); // the HTML content your controller has produced
                    $('.ajax-users-load').html($data);
                }
            });

        });
        $('.prev-page-user').on('click',function(e){
            if({{$users->currentPage()}} > 1){
                $.ajax({
                    url: '/accounts/accounts/?page='+({{$users->currentPage()}} - 1),
                    type: "GET", // not POST, laravel won't allow it
                    success: function(data){
                        $data = $(data); // the HTML content your controller has produced
                        $('.ajax-users-load').html($data);
                    }
                });
            }
        });

        $('.next-page-user').on('click',function(e){
            if({{$users->currentPage()}} < {{$users->lastPage()}}){
                $.ajax({
                    url: '/accounts/accounts/?page='+({{$users->currentPage()}} + 1),
                    type: "GET", // not POST, laravel won't allow it
                    success: function(data){
                        $data = $(data); // the HTML content your controller has produced
                        $('.ajax-users-load').html($data);
                    }
                });
            }
        });
       $( ".page-users:eq("+({{$users->currentPage()}}-1)+")").parent().addClass('active');

    });
</script>
<script type="text/javascript" src="{{ URL::to('js/account-role.js') }}"></script>


