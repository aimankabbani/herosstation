@extends('layouts.app')

@section('title', 'Home')

@section('content')

<x-hero :site="$site" />
<x-about :about="$page['about-us']"/>
<x-services :services="$site->services"/>
<x-portfolio :gallery="$site->media" />
<x-contact />

@endsection