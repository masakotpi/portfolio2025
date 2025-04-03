
@extends('recipe_layout')
@section('title')
レシピ詳細
@php
   $color = [
    1 => ['お菓子','pink' ],
    2 => ['パン','orange' ],
    3 => ['サラダ','green' ],
    4 => ['魚介類','skyblue' ],
    5 => ['肉料理','brown' ],
    6 => ['ご飯','lightyellow' ],
    7 => ['麺類','lightyellow' ],
    8 => ['スープ','lightgreen' ],
];
@endphp

@endsection

@section('content')


<div class="container-fluid">
  <h2 class="text-black">
    {{$recipe->id}}. {{$recipe->name}}
  </h2>
  @if ($recipe->main_image)
    <div style="width: 500px;">
      <img src="{{Storage::url($recipe->main_image)}}" alt="" width="100%">
    </div>
  @endif
  {{-- 材料テーブル --}}
  <div class="table-responsive">
    <table class="table bg-white">
      <thead>
        <tr>
          <th scope="col">材料</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($recipe->ingredient as $index => $ingredient)
        <tr class="">
          <td width="10%">{{$index+1}}</td>
          <td width="40%">{{$ingredient->mstIngredient->name}}</td>
          <td >
            {{Form::text('amount',$ingredient->amount,['class'=>'form-control d-inline w-25'])}}
            <span>{{$ingredient->mstIngredient->unit}}</span>
          </td>
          <td>
            {{Form::open(['method' => 'delete', 'id' =>'delete'.$index])}}
            <td><button formtype="submit" formaction="{{route('ingredients_delete',['id' => $ingredient->id])}}" class="button btn-danger btn-sm">削除</button></td>
            {{Form::close()}}
          </td>
        </tr>
        @endforeach
        {{-- 材料新規登録 --}}
        <tr class="">
          {{Form::open(['method' => 'post'])}}
          <td width="10%">@if(isset($index)){{$index+2}} @else 1 @endif</td>
          <td>
            {{Form::select('mst_ingredient_id[]',$mst_ingredient_selector,'',['class'=>'form-control d-inline w-100','placeholder'=>'材料を選択してください'])}}
          </td>
          <td>
            {{Form::text('amount[]','',['class'=>'form-control d-inline w-25'])}}
            {{Form::hidden('recipe_id',$recipe->id)}}
            {{Form::hidden('type',$recipe->type)}}
            {{Form::hidden('name',$recipe->name)}}
          </td>
          <td>
           
            <td><button formtype="submit" formaction="{{route('ingredients_store')}}" class="button btn-primary btn-sm">新規登録</button></td>
            {{Form::close()}}
          </td>
        </tr>
      </tbody>
    </table>
    {{-- 工程テーブル --}}
    <table class="table bg-white my-5">
      <thead>
        <tr>
          <th scope="col">工程</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($recipe->process as $index => $process)
        <tr class="">
          {{Form::open(['method' => 'put', 'id' =>'update'.$index])}}
          <td width="10%">{{$index+1}}</td>
          <td>{{Form::text('process',$process->process,['class'=>'form-control'])}}</td>
          <td>
            <td><button formtype="submit" formaction="{{route('process_update',['id' => $process->id])}}" class="button btn-primary btn-sm">更新</button></td>
            {{Form::close()}}
          </td>
          <td>
            {{Form::open(['method' => 'delete', 'id' =>'delete'.$index])}}
            <td><button formtype="submit" formaction="{{route('process_delete',['id' => $process->id])}}" class="button btn-danger btn-sm">削除</button></td>
            {{Form::close()}}
          </td>
        </tr>
        @endforeach
        {{-- 工程新規登録 --}}
        <tr class="">
          {{Form::open(['method' => 'post'])}}
          <td width="10%">@if(isset($index)){{$index+2}} @else 1 @endif</td>
          <td>
            {{Form::text('process[]','',['class'=>'form-control d-inline w-100'])}}
          </td>
            {{Form::hidden('recipe_id',$recipe->id)}}
            {{Form::hidden('is_return',true)}}
            {{Form::hidden('number',$index ? $index+1 : 0)}}
          <td>
            <td><button formtype="submit" formaction="{{route('process_store')}}" class="button btn-primary btn-sm">新規登録</button></td>
            {{Form::close()}}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
</div>
  

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>

