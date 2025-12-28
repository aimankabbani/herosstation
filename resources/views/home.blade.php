@extends('layouts.app')

@section('title', 'Home')

@section('content')

<x-hero :title="$site->name" :phoneNumber="$site->phone_number" :slogan="$site->slogan"/>
<x-about />
<x-services />
<x-portfolio :gallery="$site->media"/>
<x-contact />
@endsection