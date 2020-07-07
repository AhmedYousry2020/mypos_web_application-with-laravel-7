@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('site.users')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active"><i class="fa fa-user"></i>@lang('site.users')</li>

            </ol>
        </section>
        <section class="content">
           <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.users') <strong>{{$users->total()}}</strong></h3>
                <form action="{{route('dashboard.users.index')}}" method="get">
                    <div class="row">
               <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->input('search')}}">
               </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i>@lang('site.search')</button>
                            @if(auth()->user()->hasPermission('create_users'))
                            <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
                            @else

                            <a href="#" class="btn btn-primary" disabled=""><i class="fa fa-plus"></i>@lang('site.add')</a>
                            @endif
                    </div>
                    </div>
                </form>


            </div>
            <div class="box-body">
                  @if($users->count()>0)
                       <table class="table table-bordered table-hover">
                           <thead>
                           <tr>
                               <th>#</th>
                               <th>@lang('site.first_name')</th>
                               <th>@lang('site.last_name')</th>
                               <th>@lang('site.email')</th>
                               <th>@lang('site.image')</th>

                               <th>@lang('site.action')</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($users as $index=>$user)
                           <tr>
                               <td>{{$index+1}}</td>
                               <td>{{$user->first_name}}</td>
                               <td>{{$user->last_name}}</td>
                               <td>{{$user->email}}</td>
                               <td><img src="{{$user->image_path}}" alt="" style="width: 90px;" class="img-thumbnail"></td>


                               <td>
                                   @if(auth()->user()->hasPermission('update_users'))
                                       <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                   @else
                                       <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                   @endif
                                   @if(auth()->user()->hasPermission('delete_users'))
                                   <form method="post" class="delete" action="{{route('dashboard.users.destroy',$user->id)}}" style="display: inline-block">
                                       @csrf
                                       @method('delete')
                                       <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                                   </form>
                                   @else
                                       <button  class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                                   @endif
                               </td>
                           </tr>

                           @endforeach
                           </tbody>

                       </table>
                    {{$users->appends(request()->query())->links()}}
                   @else
                       <h2>@lang('site.no_data_found')</h2>

                   @endif

               </div>
           </div>
        </section>
    </div>

@endsection
