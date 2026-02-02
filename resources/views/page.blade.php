@extends('layouts.app')

@section('content')
<div class="container">
   {!! $page->{"content_".Lang::getLocale()} !!}
</div>
@endsection