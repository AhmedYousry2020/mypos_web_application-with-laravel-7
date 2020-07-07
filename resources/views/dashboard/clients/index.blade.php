@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('site.clients')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active"><i class="fa fa-user"></i>@lang('site.clients')</li>

            </ol>
        </section>
        <section class="content">
           <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.clients') <strong>{{$clients->count()}}</strong></h3>
                <form action="{{route('dashboard.clients.index')}}" method="get">
                    <div class="row">
               <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{request()->input('search')}}">
               </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i>@lang('site.search')</button>
                            @if(auth()->user()->hasPermission('create_clients'))
                            <a href="{{route('dashboard.clients.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
                            @else

                            <a href="#" class="btn btn-primary" disabled=""><i class="fa fa-plus"></i>@lang('site.add')</a>
                            @endif
                    </div>
                    </div>
                </form>


            </div>
            <div class="box-body">
                  @if($clients->count()>0)
                       <table class="table table-bordered table-hover">
                           <thead>
                           <tr>
                               <th>#</th>
                               <th>@lang('site.name')</th>
                               <th>@lang('site.phone')</th>
                               <th>@lang('site.address')</th>
                               <th>@lang('site.add_order')</th>
                               
                               <th>@lang('site.action')</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($clients as $index=>$client)
                           <tr>
                               <td>{{$index+1}}</td>
                               <td>{{$client->name}}</td>
                               <td>{{ implode(array_filter($client->phone),'-')}} </td>
                               <td>{{$client->address}} </td>
                               @if(auth()->user()->hasPermission('create_orders'))
                               <td><a href="{{route('dashboard.clients.orders.create',$client->id)}}" class="btn btn-primary btn-sm">@lang('site.add_order')</a></td>
                               @endif
                               <td>
                                   @if(auth()->user()->hasPermission('update_clients')) 
                                       <a href="{{route('dashboard.clients.edit',$client->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                   @else
                                       <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                   @endif
                                   @if(auth()->user()->hasPermission('delete_clients'))
                                   <form method="post" class="delete" action="{{route('dashboard.clients.destroy',$client->id)}}" style="display: inline-block">
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
{{$clients->appends(request()->query())->links()}}                  
                   @else
                       <h2>@lang('site.no_data_found')</h2>

                   @endif

               </div>
           </div>
        </section>
    </div>

@endsection
