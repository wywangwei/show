@extends('erp.father.static')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>仓储数据管理系统</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- <script>
  /^http(s*):\/\//.test(location.href) || alert('请先部署到 localhost 下再访问');
  </script> -->
  <style>
  .monitor{
    position: fixed;
    bottom: 58px;
    right: 70px;
    z-index: 999;
  }
  .monitor_title{
    text-align: center;
    line-height:100px;
    width: 100px;
    height: 100px;
    background-color: #fff;
    border-radius: 50%;
    border:1px solid #666;
    cursor: pointer;
  }
  .monitor_content{
    display:none;
    overflow: hidden;
    height: 400px;
    background: #fff;
    position: relative;
    border: 1px solid #ccc9c9;
  }
  .close{
    width: 14px;
    height: 14px;
    background-position: 1px -40px;
    float: right;
    cursor: pointer;
    margin-right: 10px;
  }
  .git_monitor{
    cursor: pointer;
  }
  .monitor_content_title{
    position: absolute;
    top: 6px;
    z-index: 999;
    width: 100%;
    padding-bottom: 6px;
    border-bottom: 1px solid #ccc9c9;
    background-color: #fff;
  }
  </style>
</head>
{{--<body class="layui-layout-body">--}}
<body>
@section('content')
  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="/admins/index" target="_blank" title="仓储管理系统">
              <i class="layui-icon layui-icon-website"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <input style="margin-top: 10px;" type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search"  layadmin-event="serach" lay-action="template/search.html?keywords=">
          </li>
        </ul>
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="theme">
              <i class="layui-icon layui-icon-theme"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="note">
              <i class="layui-icon layui-icon-note"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="fullscreen">
              <i class="layui-icon layui-icon-screen-full"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">
              <cite>{{Auth::guard('admin')->user()->username}}</cite>
            </a>
            <dl class="layui-nav-child">
              <dd><a lay-href="{{url('/admins/admin/')}}/{{Auth::guard('admin')->user()->id}}">基本资料</a></dd>
              <dd><a lay-href="/admins/password">修改密码</a></dd>
              <hr>
              <dd style="text-align: center;"><a href="/admins/logout">退出</a></dd>
            </dl>
          </li>

          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
          <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
            <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
        </ul>
      </div>

      <!-- 侧边菜单 -->
      @include('erp.father.aside')
      <!-- 页面标签 -->
      <div class="layadmin-pagetabs" id="LAY_app_tabs">
        <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-down">
          <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect>
              <a href="javascript:;"></a>
              <dl class="layui-nav-child layui-anim-fadein">
                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
          </ul>
        </div>
        <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
          <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="home/console.html" lay-attr="home/console.html" class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
          </ul>
        </div>
      </div>


      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <!-- <div class="monitor">
          <div class="monitor_title">
            网页监控
          </div>
          <div class="monitor_content">
            <div class="monitor_content_title"><a lay-href="/admin/worker/monitor/page/list" id="monitor">
              <button class="layui-btn layui-btn-xs"style="margin-left: 10px;">进入监控页面</button></a>
              <div class="layui-layer-ico close">

              </div>
            </div>
            <div class="" style="margin-top: 28px;height:372px;overflow: auto;">
                <table id="table1" lay-filter='table1'></table>
            </div>
          </div>
        </div> -->
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="/admins/home_page" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>

      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>
@endsection
@section('js')
  <script>
  layui.config({
    base: '/admin/layuiadmin/' //静态资源所在路径
  }).extend({
      index: 'lib/index' //主入口模块
  // }).use('index');
  }).use(['index','admin','setter','laytpl','table'],function () {
      var that = this,
          laytpl = layui.laytpl,
          table = layui.table,
          setter = layui.setter,
          $ = layui.jquery,
          $body = $('body'),
          device = layui.device(),
          LayuiTheme = "LayuiTheme";

      //主题设置
  function themes(options){
          var theme = setter.theme
              ,local = layui.data(LayuiTheme)
              ,id = 'LAY_layadmin_theme'
              ,style = document.createElement('style')
              ,styleText = laytpl([
              //主题色
              '.layui-side-menu,'
              ,'.layadmin-pagetabs .layui-tab-title li:after,'
              ,'.layadmin-pagetabs .layui-tab-title li.layui-this:after,'
              ,'.layui-layer-admin .layui-layer-title,'
              ,'.layadmin-side-shrink .layui-side-menu .layui-nav>.layui-nav-item>.layui-nav-child'
              ,'{background-color:@{{d.color.main}} !important;}'

              //选中色
              ,'.layui-nav-tree .layui-this,'
              ,'.layui-nav-tree .layui-this>a,'
              ,'.layui-nav-tree .layui-nav-child dd.layui-this,'
              ,'.layui-nav-tree .layui-nav-child dd.layui-this a'
              ,'{background-color:@{{d.color.selected}} !important;}'

              //logo
              ,'.layui-layout-admin .layui-logo{background-color:@{{d.color.logo || d.color.main}} !important;}'

              //头部色
              ,'@{{# if(d.color.header){ }}'
              ,'.layui-layout-admin .layui-header{background-color:@{{ d.color.header }};}'
              ,'.layui-layout-admin .layui-header a,'
              ,'.layui-layout-admin .layui-header a cite{color: #f8f8f8;}'
              ,'.layui-layout-admin .layui-header a:hover{color: #fff;}'
              ,'.layui-layout-admin .layui-header .layui-nav .layui-nav-more{border-top-color: #fbfbfb;}'
              ,'.layui-layout-admin .layui-header .layui-nav .layui-nav-mored{border-color: transparent; border-bottom-color: #fbfbfb;}'
              ,'.layui-layout-admin .layui-header .layui-nav .layui-this:after, .layui-layout-admin .layui-header .layui-nav-bar{background-color: #fff; background-color: rgba(255,255,255,.5);}'
              ,'.layadmin-pagetabs .layui-tab-title li:after{display: none;}'
              ,'@{{# } }}'
          ].join('')).render(options = $.extend({}, local.theme, options))
              ,styleElem = document.getElementById(id);

          //添加主题样式
          if('styleSheet' in style){
              style.setAttribute('type', 'text/css');
              style.styleSheet.cssText = styleText;
          } else {
              style.innerHTML = styleText;
          }
          style.id = id;

          styleElem && $body[0].removeChild(styleElem);
          $body[0].appendChild(style);
          $body.attr('layadmin-themealias', options.color.alias);

          //本地存储记录
          local.theme = local.theme || {};
          layui.each(options, function(key, value){
              local.theme[key] = value;
          });
          layui.data(LayuiTheme, {
              key: 'theme'
              ,value: local.theme
          });
      }

      //初始
      !function(){
          //主题初始化，本地主题记录优先，其次为 initColorIndex
          var local = layui.data(LayuiTheme);
          if(local.theme){
              themes(local.theme);
          } else if(setter.theme){
              initTheme(13);
          }

          //常规版默认开启多标签页
          if(!('pageTabs' in layui.setter)) layui.setter.pageTabs = true;

          //不开启页面标签时
          if(!setter.pageTabs){
              $('#LAY_app_tabs').addClass(HIDE);
              container.addClass('layadmin-tabspage-none');
          }

          //低版本IE提示
          if(device.ie && device.ie < 10){
              view.error('IE'+ device.ie + '下访问可能不佳，推荐使用：Chrome / Firefox / Edge 等高级浏览器', {
                  offset: 'auto'
                  ,id: 'LAY_errorIE'
              });
          }
          if(location.href.indexOf('id')!==-1){
            $('#monitor').trigger("click")
          }
      }();

      //主题设置
  function setTheme (othis){
          var index = othis.data('index')
              ,nextIndex = othis.siblings('.layui-this').data('index');

          if(othis.hasClass(THIS)) return;

          othis.addClass(THIS).siblings('.layui-this').removeClass(THIS);
          initTheme(index);
      };

  //初始化主题
  function initTheme (index){
          var theme = setter.theme;
          index = index || 13;
          if(theme.color[index]){
              theme.color[index].index = index;
              themes({
                  color: theme.color[index]
              });
          }
      }
      // layui.admin.initTheme(14);
      $('body').on('click','.monitor_title',function(){
        $(this).hide(400);
        table.reload('table1');
        $('.monitor_content').show(400);
      })

    $('body').on('click','.close',function(){
      $('.monitor_title').show(400);
      $('.monitor_content').hide(400)
    });
    $('body').on('click','#monitor',function(){
    })
  });
  </script>
  @endsection
</body>
</html>
