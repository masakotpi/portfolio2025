
@extends('recipe_layout')
@section('title')
レシピ工程登録：{{$recipe->name}}
@endsection

@section('content')


{{Form::open(['method' => 'post', 'id' =>'form'])}}
<div class="float-right">
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newIngredientModal">工程登録</button>
</div>
{{Form::hidden('recipe_id',$id,['class' => 'form-control form-control-sm mb-3','form' =>'form'])}}


<div class="process_ing"></div>
<button type="button" class="btn-success process" ></button>

{{-- 材料 --}}
<div class="my-2">
@foreach($recipe['ingredient'] as $ingredient)
<button type="button" class="btn-pink process_ing" data="ingredient">{{$ingredient->name}}</button>
@endforeach
</div>
{{-- 工程 --}}
<div class="my-2">
@foreach($recipe['process'] as $process)
<button type="button" class="btn-primary process" data="process">{{$process}}</button>
@endforeach
</div>
<div class="my-2">
<button type="button" class="btn-secondary process_ing" >、</button>
<button type="button" class="btn-secondary process" >\n</button>
<button type="button" class="btn-secondary process_clear" >クリア</button>
<button type="button" class="btn-secondary delete_one_letter" >一文字削除</button>
</div>
<div class="my-2">
<button type="button" class="btn-warning process" data="process">10分</button>
<button type="button" class="btn-warning process" data="process">20分</button>
<button type="button" class="btn-warning process" data="process">30分</button>
<button type="button" class="btn-warning process" data="process">40分</button>
<button type="button" class="btn-warning process" data="process">50分</button>
<button type="button" class="btn-warning process" data="process">1時間</button>
<button type="button" class="btn-warning process" data="process">２時間</button>
<button type="button" class="btn-warning process" data="process">3時間</button>
<button type="button" class="btn-warning process" data="process">4時間</button>
<button type="button" class="btn-warning process" data="process">5時間</button>
</div>
<textarea class="my-2 w-100 textarea" style="color:#572e0b;" rows="2"></textarea>
<button type="button" class="btn btn-danger confirm" >1工程確定</button>


<table class="table">
  <thead>
    <tr>
      <td widtd="3%"></td>
    
    </tr>
  </thead>
  <tbody class="process_body"></tbody>
</table>





<button type="submit"  formaction="{{route('process_store')}}" class="btn btn-danger d-block">送信</button>

{{Form::close()}}
  

<!-- 工程登録モーダル -->
<div class="modal fade" id="newIngredientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">工程登録</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            {{Form::open(['method'=>'POST'])}}
            <tr>
              {{Form::hidden('type',$recipe['type'],['class' => 'form-control form-control-sm mb-3'])}}
              <th scope="col" width="10%">工程名<small class="text-white badge bg-danger m-3">必須</small></th>
              <td>{{Form::text('process','',['class'=>'form-control'])}}</td>
            </tr>
          </thead>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" formmethod="post" class="btn btn-primary btn" formaction="{{route('mst_process_store')}}">登録</button>
      </div>
    </div>
  </div>
</div>

{{Form::close()}}

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>