@if ($paginator->hasPages())
    <!-- 自己添加 -->
    <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
     <!-- 自己添加 -->
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <!-- 自己添加 禁layui-disabled-->
                <a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">上一页</a>
                <!-- 自己添加 禁layui-disabled-->
            @else
                <!-- 自己添加 -->
                 <a href="{{ $paginator->previousPageUrl() }}" class="layui-laypage-prev" data-page="0">上一页</a>
                 <!-- 自己添加 -->
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <!-- 自己添加 -->
                            <span class="layui-laypage-curr">
                                <em class="layui-laypage-em"></em>
                                <em>{{ $page }}</em>
                                </span>
                                <!-- 自己添加 -->
                        @else
                            <!-- 自己添加 -->
                            <a href="{{ $url }}" data-page="2">{{ $page }}</a>
                            <!-- 自己添加 -->
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <!-- 自己添加 -->
                <a href="{{ $paginator->nextPageUrl() }}" class="layui-laypage-next" data-page="2">下一页</a>
                <!-- 自己添加 -->
            @else
                <!-- 自己添加 禁layui-disabled -->
                <a href="javascript:;" class="layui-laypage-next layui-disabled" data-page="2">下一页</a>
                <!-- 自己添加 禁layui-disabled -->
            @endif
      </div>
@endif
