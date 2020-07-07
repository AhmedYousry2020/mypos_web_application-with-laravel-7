@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('site.users')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.users.index')}}">@lang('site.users')</a></li>
                <li class="active">@lang('site.edit')</li>

            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div>
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{route('dashboard.users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label> @lang('site.first_name')</label>
                            <input class="form-control" type="text" name="first_name" value="{{$user->first_name}}" >
                        </div>

                        <div class="form-group">
                            <label> @lang('site.last_name')</label>
                            <input class="form-control" type="text" name="last_name" value="{{$user->last_name}}" >
                        </div>

                        <div class="form-group">
                            <label> @lang('site.email')</label>
                            <input class="form-control" type="email" name="email" value="{{$user->email}}" >
                        </div>

                        <div class="form-group">
                            <label> @lang('site.image')</label>
                            <input type="file" class="form-control image" name="image" >
                        </div>

                        <div class="form-group">

                            <img src="{{$user->image_path}}" style="width:100px" class="img-thumbnail image-preview" alt="">
                        </div>


                        <div class="form-group">
                            <label>@lang('site.permissions')</label>
                            <div class="nav-tabs-custom">
                                @php
                                $modules = ['users','categories','products','clients','orders'];
                                    $maps=['create','read','update','delete'];
                                @endphp
                                <ul class="nav nav-tabs">
                                    @foreach($modules as  $index=>$module)
                                        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $module }}" data-toggle="tab">@lang('site.'.$module)</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach($modules as  $index=>$module)
                                        <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$module}}">
                                            @foreach($maps as $map)
                                                <label><input type="checkbox" name="permissions[]" {{$user->hasPermission($map.'_'.$module) ? 'checked' : ''}} value="{{ $map.'_'.$module}}">@lang('site.'.$map)</label>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>@lang('site.edit')</button>
                        </div>
                    </form>

                </div>

            </div>
        </section>
    </div>

@endsection
