@extends('layouts.raw')

@section('content')

@include('backend.component.message_block')
@include('backend.component.button-back',['link'=>'/admin-post','text'=>'BACK'])

<div class="row">
    {{-- @if ($konten->konten_model == 2) --}}
        @include('backend.post.component.form2')
    {{-- @endif --}}
</div>

@endsection


@section('script')
    @include('backend.post.component.js_form2')
@endsection