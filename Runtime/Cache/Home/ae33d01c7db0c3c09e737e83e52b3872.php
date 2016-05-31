<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title><?php echo empty($page_title) ? C('WEB_SITE_TITLE') : $page_title; ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/mobile_module.css?v=<?php echo SITE_VERSION;?>" media="all">
    <script type="text/javascript">
		//静态变量
		var IMG_PATH = "/Public/Home/images";
		var STATIC_PATH = "/Public/static";
		var SITE_URL = "<?php echo SITE_URL;?>";
		var WX_APPID = "<?php echo ($jsapiParams["appId"]); ?>";
		var	WXJS_TIMESTAMP='<?php echo ($jsapiParams["timestamp"]); ?>'; 
		var NONCESTR= '<?php echo ($jsapiParams["nonceStr"]); ?>'; 
		var SIGNATURE= '<?php echo ($jsapiParams["signature"]); ?>';
	</script>
    <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="http://yaotv.qq.com/shake_tv/include/js/lib/zepto.1.1.4.min.js"></script>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript" src="minify.php?f=/Public/Home/js/prefixfree.min.js,/Public/Home/js/m/dialog.js,/Public/Home/js/m/flipsnap.min.js,/Public/Home/js/m/mobile_module.js&v=<?php echo SITE_VERSION;?>"></script>
</head>	
<link href="<?php echo ADDON_PUBLIC_PATH;?>/vote.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container body">
	<div class="vote_wrap">
  <article>
  	<div class="img_wrap">
        <img width="100%" src="<?php echo (get_cover_url($info["picurl"])); ?>">
    </div>
    <h2 style="position:static"><div style="word-wrap:break-word;"><?php echo ($info["title"]); ?></div></h2>
    <div class="content">
    	<?php echo ($info["description"]); ?>
    </div>
    <P class="total_vote">总共有<span id="totalCount"><?php echo ($info["vote_count"]); ?></span>人投票</P>
  <form id="form1" name="form1" method="post" action="<?php echo U( 'join' );?>" onSubmit="return checkForm();">
    <div class="clearfix choice_list <?php if($info['is_img'] && !empty($opt['image'])): ?>img_choice<?php endif; ?>">
      <ul>
        <?php if(is_array($opts)): $k = 0; $__LIST__ = $opts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$opt): $mod = ($k % 2 );++$k;?><!-- 带图片投票 -->
                <?php if($info['is_img'] && !empty($opt['image'])): ?><li class="pic_li <?php if($canJoin == false): ?>disable<?php endif; ?>" data-count="<?php echo ($opt["opt_count"]); ?>">
                    <p class="mb" ><span class="img_wrap"><img <?php if(in_array($opt[id], $joinData)) echo 'style="border-color:#c07b36" '; ?> src="<?php echo (get_cover_url($opt["image"])); ?>" />
                    <em class="check <?php if(in_array($opt[id], $joinData)) echo 'checked'; ?>"></em>
                    </span>
                    </p>
                    <p class="count">
                        <span class="count_num">
							<?php echo ($opt["opt_count"]); ?>
                         </span>
                          票
                    </p>
                    <p><span class="name"><?php echo (msubstr($opt["name"],0,15)); ?></span></p>
                <?php else: ?>
                	<li class="text_li <?php if($canJoin == false): ?>disable<?php endif; ?>" data-count="<?php echo ($opt["opt_count"]); ?>">
                	<div class="bar" <?php if(in_array($opt[id], $joinData)) echo 'style="font-size:16px;font-weight:bold"'; ?>">
                        <p>
                        	
                            <em class="check <?php if(in_array($opt[id], $joinData)) echo 'checked'; ?>"></em>
                            <span class="name"><?php echo ($opt["name"]); ?></span>
                        </p>
                        <p class="count">
                           
                            <span class="count_num">
                                <?php echo ($opt["opt_count"]); ?>
                             </span>
                              票
                        </p>
                        <div class="progress"></div>
                    </div><?php endif; ?>
                <p class="list" style="display:none"> 
                    <input type="radio" class="<?php echo ($style_cls); ?>" id="check_<?php echo ($opt["id"]); ?>" name="optArr[]" value="<?php echo ($opt["id"]); ?>"           
                  <?php  ?>
                  ><label for="check_<?php echo ($opt["id"]); ?>"></label>
                </p>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <?php if($canJoin == true): ?><div class="m_15">
                <a class="btn yellow_btn submit" href="javascript:;">提 交</a>
            </div><?php endif; ?>
      <?php if($overtime == true): ?><div class="m_15">
                <a class="btn gray_btn" href="javascript:;">已过期或已结束</a>
            </div><?php endif; ?>
      
    </div>
    
    <div class="warning" id="errorInfo"></div>
    <input type="hidden" value="<?php echo I('token');?>" name="token" />
    <input type="hidden" value="<?php echo I('wecha_id');?>" name="wecha_id" />
    <input type="hidden" value="<?php echo ($info["id"]); ?>" name="vote_id" />
    
  </form>
  </div>
  <p class="copyright"><?php echo ($system_copy_right); ?></p>
</div>
<!-- Wap页面脚部 -->
<div style="height:0; visibility:hidden; overflow:hidden;">
<?php echo ($tongji_code); ?>
</div>
<script type="text/javascript">
	$.WeiPHP.initWxShare({
		title:"<?php echo ($info["title"]); ?>",
		imgUrl:"<?php echo (get_cover_url($info["picurl"])); ?>",
		desc:"<?php echo ($info["description"]); ?>",
		link:window.location.href
	})
</script>
</body>
</html>
<script>
function initProgressBar(){
	var totalCount = parseInt($('#totalCount').text());
	$('.text_li').each(function(index, element) {
        var count = parseInt($(this).find('.count_num').text());
		var percent = (count/totalCount)*100+"%";
		$(this).find('.progress').width(percent).css('background-color',WeiPHP_RAND_COLOR[index]);
    });
}
$(function(){
	initProgressBar();
	
	$(".choice_list li").click(function () {
		var overtime="<?php echo ($overtime); ?>";
		var _this = $(this);
		 if(_this.hasClass('disable')){
			 if(overtime=='1'){
				 //$.Dialog.fail("该投票已过期");
			}else{
			 	//$.Dialog.fail("你已经投过票了");
			}
		   return;	
		  }else{
			  if(!_this.find('em').hasClass('checked')){
			  	_this.find("input").prop("checked", true);
			  	_this.find('em').addClass('checked');
			  }else{
				_this.find("input").prop("checked", false);
			  	_this.find('em').removeClass('checked');	 
			  }
	      }
	 });
	 $('.submit').click(function(){
		
		  var url = $('#form1').attr('action');
		  var param = $('#form1').serializeArray();
		  $.Dialog.loading();
		  $.post(url,param,function(data){
	
			  //_this.find('img').css('border-color','#c07b36');
			  //_this.find('.count_num').html((parseInt(_this.find('.count_num').text())+1));
			  // var totalCount = parseInt($('#totalCount').text());
			  //$('#totalCount').text(totalCount+1);
			  //重新算进度条
			  window.location.reload();
			  $.Dialog.close();
		  })
		
	})
	 /*
	if (typeof WeixinJSBridge == "undefined"){
		if( document.addEventListener ){
			document.addEventListener('WeixinJSBridgeReady', init_close, false);
		}else if (document.attachEvent){
			document.attachEvent('WeixinJSBridgeReady', init_close); 
			document.attachEvent('onWeixinJSBridgeReady', init_close);
		}
	}else{
		init_close();
	}	
	*/   
});
</script>