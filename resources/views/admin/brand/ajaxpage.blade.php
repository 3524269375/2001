  @foreach($brand as $v)
        <tr>
            <td>
                <input type="checkbox" name="brandcheck[]" lay-skin="primary" value="{{$v->brand_id}}">
            </td>
          <td>{{$v->brand_id}}</td>
          <td id="{{$v->brand_id}}"><span class="brand_name">{{$v->brand_name}}</span></td>
          <td>{{$v->brand_url}}</td>
          <td>
              <img src="{{$v->brand_logo}}" width="120"/>

          </td>
          <td>{{$v->brand_desc}}</td>
          <td>
              <a href="" class="layui-btn">修改</a>
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
