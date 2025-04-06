
@extends('recipe_layout')
@section('title')
材料マスター更新
@endsection



@section('content')
  @foreach(App\Consts\RecipeConst::INGREDIENT_TYPE as $index => $ingredient)
  {{Form::open(['method' => 'get','id' => 'getindex'.$index, 'class'=>"d-inline"])}}
    {{Form::hidden('type',$index,['form'=>'getindex'.$index])}}
    @if($type == $index)
    <button formtype="submit" formaction="{{route('mst_ingredients_index')}}" class="button btn-success btn-sm">{{$ingredient}}</button>
    @else
    <button formtype="submit" formaction="{{route('mst_ingredients_index')}}" class="button btn-secondary btn-sm">{{$ingredient}}</button>
    @endif
  {{Form::close()}}
@endforeach

<table class="table">
  <thead>
    <tr>
      <td widtd="40%">材料</td>
      <td widtd="15%">単位</td>
      <td widtd="15%">分量</td>
      <td widtd="15%">費用</td>
    </tr>
    <tr>
      {{Form::open(['method' => 'post'])}}
    <td widtd="40%">{{Form::text('name','',['class' =>'form-control'])}}</td>

      {{Form::hidden('type',$type,['class' =>'form-control'])}}
      <td>{{Form::text('unit','',['class' =>'form-control'])}}</td>
      <td>{{Form::text('amount','',['class' =>'form-control'])}}</td>
      <td>{{Form::text('cost','',['class' =>'form-control'])}}</td>
      <td></td>
       {{-- 更新 --}}
    <td><button type="submit" formaction="{{route('mst_ingredients_store')}}" class="button btn-primary btn-sm">登録</button></td>
    {{Form::close()}}
    </tr>
  </thead>
  @foreach($ingredients as $index => $ingredient)
  <tr class="my-0">
    <td widtd="40%">{{Form::text('name',$ingredient->name,['class' =>'form-control', 'form'=>'form'.$index])}}</td>
    {{Form::hidden('id',$ingredient->id,['form'=>'form'.$index])}}
    <td>{{Form::text('unit',$ingredient->unit,['class' =>'form-control', 'form'=>'form'.$index])}}</td>
    <td>{{Form::text('amount',$ingredient->amount,['class' =>'form-control', 'form'=>'form'.$index])}}</td>
    <td>{{Form::text('cost',$ingredient->cost,['class' =>'form-control', 'form'=>'form'.$index])}}</td>
    {{-- 削除 --}}
    {{Form::open(['method' => 'delete', 'id' =>'delete'.$index])}}
    <td><button formtype="submit" formaction="{{route('mst_ingredients_delete',['id' => $ingredient->id,'type'=>$type])}}" class="button btn-danger btn-sm">削除</button></td>
    {{Form::close()}}
    {{-- 更新 --}}
    {{Form::open(['method' => 'put', 'id' =>'form'.$index])}}
    <td><button type="submit" formaction="{{route('mst_ingredients_update',['id' => $ingredient->id])}}" class="button btn-primary btn-sm">更新</button></td>
    {{Form::close()}}
  </tr>
  @endforeach
</table>


{{-- <button type="submit"  formaction="{{route('ingredients_store')}}" class="btn-sm btn-primary d-block">送信</button> --}}

  

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>