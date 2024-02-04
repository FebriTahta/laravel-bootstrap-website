@extends('layouts.raw')

@section('css_header')

@endsection

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-konten','text'=>'BACK'])

<div class="row"> 
    @include('backend.post.component.form2',['konten'=>$konten])
</div>

@endsection


@section('script')
    @include('backend.post.component.js_form2')
@endsection