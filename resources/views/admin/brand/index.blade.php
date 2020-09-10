@extends('admin.layouts.adminshop')
@section('content')
    <!-- 内容主体区域 -->
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
          <legend>

              <span class="layui-breadcrumb">
              <a href="/">首页</a>
                <a href="/demo/">品牌管理</a>
                <a><cite>品牌展示</cite></a>
              </span>
          </legend>
        </fieldset>
     <!-- 内容主体区域 -->

   <form class="layui-form" action="">
     <div class="layui-form-item">
         <div class="layui-inline">
           <div class="layui-input-inline" style="padding-left: 30px;">
             <input type="tel" name="brand_name" placeholder="请输入品牌名称" value="{{$query['brand_name']??''}}" autocomplete="off" class="layui-input">
           </div>
         </div>
         <div class="layui-inline">
           <div class="layui-input-inline">
             <input type="text" name="brand_url" placeholder="请输入品牌网址" value="{{$query['brand_url']??''}}" autocomplete="off" class="layui-input">
           </div>
         </div>
       <div class="layui-inline">
           <div class="layui-input-inline">
            <button class="layui-btn layui-btn-normal">搜索</button>
         </div>
         </div>
       </div>
     </form>

    <div class="layui-form" style="padding-left: 15px;padding-right: 15px;padding-bottom: 15px;">
    <table class="layui-table" lay-skin="line">
      <colgroup>
        <col width="150">
        <col width="150">
        <col width="200">
        <col>
      </colgroup>
      <thead>
        <tr>
           <th width="4%">
           <input type="checkbox" name="allcheckbox" lay-skin="primary" />
           </th>
          <th>品牌id</th>
          <th>品牌名称</th>
          <th>品牌网址</th>
          <th>品牌LOGO</th>
          <td>品牌简介</td>
          <td>操作</td>
        </tr>
      </thead>
      <tbody>
          @foreach($brand as $v)
        <tr>
          <td>
              <input type="checkbox" name="brandcheck[]" lay-skin="primary" value="{{$v->brand_id}}">
          </td>
          <td>{{$v->brand_id}}</td>
          <td id="{{$v->brand_id}}" oldval="{{$v->brand_name}}">
          <span class="brand_name" >{{$v->brand_name}}</span>
          </td>
          <td id="{{$v->brand_id}}">
               <!-- <span class="brand_name">{{$v->brand_url}}</span> -->
               {{$v->brand_url}}
          </td>

          <td>
              <img src="{{$v->brand_logo}}" width="120"/>

          </td>
          <td>{{$v->brand_desc}}</td>
          <td>
              <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="layui-btn">修改</a>
              <!-- <a href="javascript:void(0)"  onclick="if(cofirm('确认删除此记录')){location.href='{{url('brand/delete/'.$v->brand_id)}}';}" class="layui-btn layui-btn-danger">删除</a> -->
              <a href="javascript:void(0)"  onclick="deleteByID({{$v->brand_id}},this)" class="layui-btn layui-btn-danger">删除</a>
          </td>
        </tr>
        @endforeach
      <div class="">
      <tr>
          <td colspan="6">
              {{$brand->appends($query)->links('vendor.pagination.adminshop')}}
              <button type="button" class="layui-btn layui-btn-normal moredel">选中删除</button>
          </td>
      </tr>
      </div>
      </tbody>
    </table>
  </div>



<script src="/admin/brand/layui/layui.js"></script>
<script src="/admin/brand/js/jquery.min.js"></script>
<script>
//JavaScript代码区域
layui.use(['element','form'], function(){
  var element = layui.element;
   var form = layui.form;

});
//即点即改 点
$(document).on('click','.brand_name',function(){
    //获取span里的brand_name值
    var brand_name=$(this).text();
    // alert(brand_name);
    //获取td里的id值
    var id=$(this).parent().attr('id');
    //把span替换成input并且input里有要修改的值
    $(this).parent().html('<input type=text class="changename input_name_'+id+'" value='+brand_name+' >');
    //页面显示的span
    $('input_name_'+id).val('').focus().val(brand_name);

    });
    //即点即改 改
    $(document).on('blur','.changename',function(){
        //获取要修改的值
        // alert(123);
        var newname=$(this).val();
        //判断是否赋值 不赋值给提示
        if(!newname){
            alert('内容不能为空');return;
        }
        //获取旧值
        var oldval =$(this).parent().attr('oldval');
        alert(oldval);
        //判断是否重新赋值 不赋值不更改
        if(newname==oldval){
             $(this).parent().html('<span class="brand_name">'+newname+'</span>');
            return;
        }
        // alert(newname);
        //获取要修改的id
        var id=$(this).parent().attr('id');
        // alert(id);
        var obj=$(this);
        // alert(obj);
        $.get('/brand/change',{id:id,newname:newname},function(res){
            // alert(res);
            if(res.code==0){
                obj.parent().html('<span class="brand_name">'+newname+'</span>')
            }
            alert(res.msg);
            location.reload();
        },'json')
    });
//全选
$(document).on('click','.layui-form-checkbox:first',function(){
    // alert(123);
    var checkedval=$('input[name="allcheckbox').prop('checked');
    // alert(checkedval);
    $('input[name="brandcheck[]"]').prop('checked',checkedval);
    if(checkedval){
        $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked');
        }else{
        $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked');
        }
});
//批删
$(document).on('click','.moredel',function(){
    // alert(123);
    var ids =new Array();
    // alert(ids);
    $('input[name="brandcheck[]"]:checked').each(function(i,k){
        // alert($(this).val());
        ids.push($(this).val());
    });
     // alert(ids);
    $.get('/brand/delete',{id:ids},function(res){
        alert(res.msg);
        location.reload();
    },'json')

})
function deleteByID(brand_id,obj){
    if(!brand_id){
        return;
    }
    $.get('/brand/delete/'+brand_id,function(res){
        alert(res.msg);
        location.reload();
    },'json')
}
//ajax 分页
// $('.layui-laypage a').click(function(){
    $(document).on('click','.layui-laypage a',function(){
    // alert(5465);
    var url=$(this).attr('href');
    // alert(url);
    $.get(url,function(res){
        // alert(res);
        $('tbody').html(res);
        layui.use(['element','form'], function(){
          var element = layui.element;
           var form = layui.form;
             form.render();
        });
    })
    return false;
})
</script>
@endsection
