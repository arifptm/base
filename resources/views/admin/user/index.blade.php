@extends('admin.template.layout')

@section('header-scripts')
  <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/iCheck/flat/purple.css">
@endsection

@section('footer-scripts')
	<script src="/bower_components/AdminLTE/plugins/iCheck/icheck.min.js"></script>
	<script src="/js/custom.js"></script>
@endsection

@section('content-top')
  @include('flash::message')
  <h1>
    Users
    <small>All Users</small>
  </h1>
@endsection

@section('content-main')
  <div class="box">    
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          <th style="width: 40px" class="icheck">{!! Form::checkbox("select-all",null,false, ['class'=>'flat-purple', 'id'=>'select-all']) !!}</th>
          <th style="width: 50px">ID</th>
          <th style="width: 100px">Image</th>
          <th>Name</th>
          <th>Email</th>
          <th>Roles</th>
          <th>Status</th>
          <th style="width: 64px">Action</th>
        </tr>
        @if (count($users) > 0)
          @foreach ($users as $user)
            <tr>
              <td class="icheck">
                {!! Form::checkbox("$user->id",null,false, ['class'=>'flat-purple item']) !!}
              </td>
              <td>
                {{ $user->id }}
              </td>
              <td>
              	<a href="/manage/users/{{$user->id}}"><img src="/assets/profiles/{{ $user->userProfile->image }}" alt="" height="30" /></a>
              </td>
              <td>
              	{{ $user->name }}
              </td>
              <td>
                {{ $user->email }}
              </td>
              <td>
                <ul>
                  @foreach($user->roles as $role)
                    <li>{{ $role->name }}</li>
                  @endforeach
                </ul>
              </td>
              <td>
                @if ($user->verified == 1) <span class="badge bg-blue">Verified</span> @else <span class="badge bg-yellow">Pending</span>  @endif
              </td>
              <td>
                {!! Form::open(['url' => '/manage/users/'.$user->id, 'method' => 'delete']) !!}
                <div class='btn-group'>
                  <a href="/manage/users/{{$user->id}}/edit" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}	                  
              </td>
            </tr>
          @endforeach
        @else
          Gak ada data
        @endif
      </table>
    </div>
    
    <div class="box-footer clearfix">
<!--       @if (count($users) > 0)
      <div class="pull-left pagination">  
        {!! Form::model($user, ['action'=> ['UserController@index'], 'role' => 'form']) !!}
          {!! Form::button('Massal', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
          {!! Form::hidden('ids', '0', ['class'=>'selected-id']) !!}
        {!! Form::close() !!} 
      </div>
      @endif -->
      {{ $users->links('vendor.pagination.bootstrap-4') }}  
    </div>
  </div>

@endsection