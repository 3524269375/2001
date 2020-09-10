
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
          @php $name=Route::currentRouteName();@endphp
        <li @if(strpos($name,'goods')!==false) class="layui-nav-item layui-nav-itemed" @else class="layui-nav-item" @endif >
          <a class="" href="javascript:;">商品管理</a>
          <dl class="layui-nav-child">
            <dd @if($name=='goods.create') class="layui-this"  @endif ><a href="javascript:;">商品添加</a></dd>
            <dd @if($name=='goods') class="layui-this" @endif ><a href="javascript:;">商品展示</a></dd>
          </dl>
        </li>
        <li @if(strpos($name,'brand')!==false) class="layui-nav-item layui-nav-itemed" @else class="layui-nav-item" @endif >
          <a href="javascript:;">品牌管理</a>
          <dl class="layui-nav-child">
            <dd  @if($name=='brand.create') class="layui-this"  @endif ><a href="{{url('/brand/create')}}">品牌添加</a></dd>
            <dd  @if($name=='brand') class="layui-this"  @endif ><a href="{{url('/brand')}}">品牌展示</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item"><a href="">云市场</a></li>
        <li class="layui-nav-item"><a href="">发布商品</a></li>
      </ul>
    </div>
  </div>