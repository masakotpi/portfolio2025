
@extends('recipe_layout')
@section('title')
工程マスタ更新

@endsection
@php
$INGREDIENT_TYPE = [
    1 => 'お菓子',
    2 => 'パン',
    3 => 'サラダ',
    4 => '魚介類',
    5 => '肉料理',
    6 => 'ご飯',
    7 => '麺類',
    8 => 'スープ',
];
@endphp


@section('content')
@foreach($INGREDIENT_TYPE as $index => $mst_process)
{{Form::open(['method' => 'get','id' => 'getindex'.$index, 'class'=>"d-inline"])}}
  {{Form::hidden('type',$index,['form'=>'getindex'.$index])}}
  @if($type == $index)
  <button formtype="submit" formaction="{{route('mst_process_index')}}" class="button btn-success btn-sm">{{$mst_process}}</button>
  @else
  <button formtype="submit" formaction="{{route('mst_process_index')}}" class="button btn-secondary btn-sm">{{$mst_process}}</button>
  @endif
{{Form::close()}}
@endforeach

<table class="table">
  <thead class="mb-4">
    <tr>
      <td widtd="60%">工程</td>
    </tr>
    <tr>
      {{Form::open(['method' => 'post'])}}
      {{Form::hidden('type',$type)}}
      <td>{{Form::text('process','',['class' =>'form-control','placeholder'=>'新規登録'])}}</td>
      <td><button type="submit" formaction="{{route('mst_process_store')}}" class="button btn-primary btn">新規登録</button></td>
        {{Form::close()}}
    </tr>
  </thead>
  @foreach($mst_processes as $index => $mst_process)
  <tr class="my-5">
    {{Form::hidden('id',$mst_process->id,['form'=>'form'.$index])}}
    {{Form::hidden('type',$mst_process->type,['form'=>'form'.$index])}}
    <td>{{Form::text('process',$mst_process->process,['class' =>'form-control', 'form'=>'form'.$index])}}</td>
    {{Form::open(['method' => 'put', 'id' =>'form'.$index])}}
    <td><button id='form'.$index type="submit" formaction="{{route('mst_process_update',['id' => $mst_process->id])}}" class="button btn-primary btn">更新</button></td>
    {{Form::close()}}
    {{Form::open(['method' => 'delete', 'id' =>'delete'.$index])}}
    <td><button formtype="submit" formaction="{{route('mst_process_delete',['id' => $mst_process->id])}}" class="button btn-danger btn">削除</button></td>
    {{Form::close()}}
  </tr>
  @endforeach
</table>



@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>