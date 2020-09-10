@extends('admin.layouts.adminshop')
@section('content')
    <!-- 内容主体区域 -->
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
          <legend>

              <span class="layui-breadcrumb">
              <a href="/">首页</a>
                <a href="/demo/">品牌管理</a>
                <a><cite>修改品牌</cite></a>
              </span>
          </legend>
        </fieldset>
     <!-- 内容主体区域 -->
    <div style="padding: 15px;">
      <!--  报错
        @if ($errors->any())
        <div class="alert alert-danger" style="padding-bottom: 15px;padding-left: 20px;">
        <ul>
        @foreach ($errors->all() as $error)
        <li style="margin-top: 10px;color: red;">{{ $error }}</li>
        @endforeach
        </ul>
        </div>
        @endif
       报错 -->
    <form class="layui-form" action="{{url('/brand/update/'.$brand->brand_id)}}" method="post">
        @csrf
      <div class="layui-form-item">
        <label class="layui-form-label">品牌名称：</label>
        <div class="layui-input-block">
          <input type="text" name="brand_name" value="{{$brand->brand_name}}" lay-verify="title" autocomplete="off" placeholder="请输入品牌名称" class="layui-input">
          <!-- 下边展示 -->
          <b style="color: red;">{{$errors->first('brand_name')}}</b>
        <!-- 下边展示 -->
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌网址：</label>
        <div class="layui-input-block">
          <input type="text" name="brand_url"value="{{$brand->brand_url}}"  lay-verify="title" autocomplete="off" placeholder="请输入品牌网址" class="layui-input">
          <!-- 下边展示 -->
            <b style="color: red;">{{$errors->first('brand_url')}}</b>
          <!-- 下边展示 -->
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌LOGO</label>
        <div class="layui-input-block">
         <div class="layui-upload-drag" id="test10">
           <i class="layui-icon"></i>
           <p>点击上传，或将文件拖拽到此处</p>
           <div @if(!$brand->brand_desc)class="layui-hide" @endif id="uploadDemoView">
             <hr>
             <img src="{{$brand->brand_logo}}" alt="上传成功后渲染" style="max-width: 196px">
           </div>
         </div>
         <input type="hidden" name="brand_logo" @if($brand->brand_logo) value='{{$brand->brand_logo}}' @endif/>
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌简介：</label>
        <div class="layui-input-block">
            <textarea name="brand_desc">{{$brand->brand_desc}}</textarea>
          <!-- 下边展示 -->
            <b style="color: red;">{{$errors->first('brand_desc')}}</b>
          <!-- 下边展示 -->
        </div>
        </div>
      <div class="layui-form-item" align="center">
      <button type="submit" class="layui-btn" >修改信息</button>
      <button type="reset" class="layui-btn layui-btn-primary" >重置</button>
      </div>
      </form>
      </div>
<script src="/admin/brand/layui/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;

});

layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
            upload.render({
                elem: '#test10'
                ,url: 'http://www.2001.com/brand/upload' //改成您自己的上传接口
                ,done: function(res){
                  layer.msg(res.msg);
                  layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src',res.data);
                  layui.$('input[name="brand_logo"]').attr('value',res.data);
                }
              });
  });
</script>
@endsection