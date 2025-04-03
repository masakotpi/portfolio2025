
@extends('recipe_layout')
@php
    $main_image = 'recipe_images/1_fuyuto.jpeg';
@endphp
@section('title')
テストです。
@endsection

@section('content')
<div id="app">
  <div class="container col-4 text-primary">
    {{$main_image}}
    @{{this.mainImage}}
    @{{mainImage}}
    {{-- <img v-if="mainImage" src="@{{this.mainImage)}}" width="100%"> --}}
  </div>
</div>
@endsection
<script>
 const app = new Vue({
    el:"#app",
    data:{
      mainImage:'vueの変数です。',
    },
    methods:{
      countUp:function(){
        this.number = this.number+1
      }
    },
    computed:{
      custom_color:function(){
          return this.color.toUpperCase();
      },
    }
  })
</script>
