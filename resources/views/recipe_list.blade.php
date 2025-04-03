
@extends('recipe_layout')
@section('title')
レシピ一覧
@php
   $ingredient_type = [
    1 => 'お菓子',
    2 => 'パン',
    3 => 'サラダ',
    4 => '魚介類',
    5 => '肉料理',
    6 => 'ご飯',
    7 => '麺類',
    8 => 'スープ',
];
$color  = [
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
<div class="container-fluid bg-white">
<div class="container-fluid">
  <div class="card text-start mb-5">
    <div class="card-body">
      {{ Form::open(['url'=>route('recipes_list'),'method'=>'get','id'=>'search']) }}
      <h4 class="card-title">検索</h4>
      <div class="input-group flex-nowrap my-4">
        <div class="input-group-prepend">
          <span class="input-group-text" id="addon-wrapping">カテゴリー</span>
        </div>
        {{Form::select('type', $ingredient_type,$request->type,['class'=>'form-control','placeholder'=>'選択してください'])}};
      </div>
      <div class="input-group flex-nowrap">
        <div class="input-group-prepend">
          <span class="input-group-text" id="addon-wrapping">レシピ名</span>
        </div>
        {{Form::select('name',$recipes['names'],$request->name,['class'=>'form-control','placeholder'=>'選択してください'])}};
      </div>
      {{form::close()}}
    </div>
  </div>
  
  @foreach($recipes['data'] as $index => $recipe)
    <table class="table table-sm table-bordered">
      <tr>
        <td colspan="3" class="bg-white text-right">
          <div class="pr-5 d-flex justify-content-between">
            <div class="text-right">
              {{$index+1}}. <button class="badge rounded-pill text-white" style="background-color:{{$color[$recipe->type][1]}};">{{$color[$recipe->type][0]}}</button> {{$recipe->name}}  @if($recipe->kcal){{$recipe->kcal}}kcal @endif
            </div>
            <div class="mr-5">
              <a href="/recipes/{{$recipe->id}}" targe="_blank" class="btn btn-primary">詳細</a>
            </div>

          </div>
        </td>
      </tr>
      <tr class="bg-white">
        <td>
          <div class="d-flex justify-content-between">
            <div class="">画像</div>
            <div class="">
              <label class="input-group-btn">
                <div class="btn-sm btn-primary buttonImage{{$index}}">
                  更新{{form::file('file',['class' => 'd-none uploadFile', 'id' =>"image_$index",'data-id' =>$recipe->id ,'data-index' =>"$index"])}}
                </span>
              </label>
            </span>
          </div>
          </td>
        <td>材料</td>
        <td>工程
        </td>
      </tr>
      <tr class="bg-white" style="height:200px">
        <td width="20%">
          {{Form::open()}}
          <form action="" method="post" enctype="multipart/form-data">
            <div class="imagePreview"></div>
            <div class="input-group">
              @if ($recipe->main_image)
              <img src="{{Storage::url($recipe->main_image)}}" width="100%" id="main_image{{$index}}">
              @else
              <img src="{{Storage::url($recipe->main_image)}}" class="d-none" width="100%" id="main_image{{$index}}">
              @endif
            </div>
          </form>
         {{Form::close()}}

        </td>
        <td width="30%" class="bg-white">
          @foreach($recipe->ingredient as $ingredient) 
          <div class="d-flex">
          <div class="col-8 d-inline pl-4">
         　{{$ingredient->mstIngredient->name}}</div>
          <div class="col-4 d-inline">{{$ingredient->amount}}
         {{$ingredient->mstIngredient->unit}} </div>
          </div>
          @endforeach
        </td>
        <td width="50%" class="bg-white">
            @foreach($recipe->process as $index => $process)
            　{{$index+1}}. {{$process->process}}<br>
            @endforeach
        </td>
      </tr>
    </table>
    @endforeach<br>
  </div>
</div>
{{Form::close()}}
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="{{ asset('js/recipes.js') }}"></script>

<script>
  $(document).ready(function () {
      $(':File').on('change', function() {
        let index = $(this).attr('data-index');
          //アップロードするファイルのデータ取得
          var form = new FormData();
          form.append("file", $(this).prop('files')[0]);
          form.append("directory", 'recipe_images');
          form.append("recipe_id", $(this).attr('data-id'));
          $.ajax({
              type: "POST",
              url: "{{ route('image_upload')}}",
              data: form,
              processData: false,
              contentType: false,
              success: function (response) {
                console.log('success',response);
                path = response.path;
                $('#main_image'+index).attr('src',response.url).removeClass('d-none') ;
              },
              error: function (response) {
                //エラー時の処理
                console.log($.parseJSON(response.responseText).message);
                $errors = $.parseJSON(response.responseText).message;
                $('.showMessage').append('<div class="alert alert-danger">'+$errors);
                
              }
          });
        });
      $('[name="name"],[name="type"]').on('change', function() {
        $('#search').submit();
      })
  })
  </script>