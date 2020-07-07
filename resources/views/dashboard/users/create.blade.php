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
                <li class="active">@lang('site.add')</li>

            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div>
                <div class="box-body">
                @include('partials._errors')
                     <form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">
                         @csrf
                         @method('post')
                         <div class="form-group">
                             <label> @lang('site.first_name')</label>
                             <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}" >
                         </div>

                        <div class="form-group">
                            <label> @lang('site.last_name')</label>
                            <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}" >
                        </div>

                        <div class="form-group">
                            <label> @lang('site.email')</label>
                            <input class="form-control" type="email" name="email" value="{{old('email')}}" >
                        </div>

                         <div class="form-group">
                             <label> @lang('site.image')</label>
                             <input class="form-control image" type="file" name="image">
                         </div>

                         <div class="form-group">

                            <img src="{{asset('storage/uploads/user_images/default.png')}}" style="width:100px" class="img-thumbnail image-preview" alt="">
                         </div>

                        <div class="form-group">
                            <label> @lang('site.password')</label>
                            <input class="form-control" type="password" name="password" >
                        </div>

                        <div class="form-group">
                            <label> @lang('site.password_confirmation')</label>
                            <input class="form-control" type="password"  name="password_confirmation" >
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
                                         <label><input type="checkbox" name="permissions[]" value="{{ $map.'_'.$module}}">@lang('site.'.$map)</label>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</button>
                        </div>
                    </form>

                </div>

            </div>
        </section>
    </div>

@endsection
