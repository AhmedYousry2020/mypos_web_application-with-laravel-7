@extends('layouts.dashboard.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @lang('site.categories')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{route('dashboard.users.index')}}">@lang('site.categories')</a></li>
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
                    <form action="{{route('dashboard.categories.update',$category->id)}}" method="post" >
                        @csrf
                        @method('put')
                        @foreach(config('translatable.locales') as $locale)
                         <div class="form-group">
                         <!-- site.ar.name-->
                             <label> @lang('site.'.$locale.'.name')</label>
                         <!--ar[name] -->
                             <input class="form-control" type="text" name="{{$locale}}[name]" value="{{$category->translate($locale)->name}}" >
                         </div>

                         @endforeach
                      


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>@lang('site.edit')</button>
                        </div>
                    </form>

                </div>

            </div>
        </section>
    </div>

@endsection
