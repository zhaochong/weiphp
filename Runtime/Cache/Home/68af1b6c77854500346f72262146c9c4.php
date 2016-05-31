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
<link href="<?php echo ADDON_PUBLIC_PATH;?>/css.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
<body>
	<div id="container" class="container body">
            <div class="top_relative">
            <?php if(!empty($forms["cover"])): ?><img src="<?php echo ($forms["cover"]); ?>"/><?php endif; ?>
            <p style="word-wrap:break-word;"><?php echo ($forms["title"]); ?></p>
            </div>
         <?php if(empty($forms["cover"])): ?><div class="top_relative"  style="background:url(<?php echo ADDON_PUBLIC_PATH;?>/background.png) no-repeat">
            <p style="font-size:20px; font-weight:bold; position:static; padding:50px 15px"><?php echo ($forms["title"]); ?></p>
            </div><?php endif; ?>
        	
        
        <?php if(!empty($forms["intro"])): if(empty($forms["content"])): ?><div class="block_content_bg p_10 m_10 " style="background-size:20px 20px; background-repeat:no-repeat; background-position:right center; "><!--word-wrap:break-word;-->
            <!--简介:<br>-->
           	<?php echo ($forms["intro"]); ?>
        </div>        
            <?php else: ?> 
    	<div class="block_content_bg p_10 m_10 icon_arrow_right_gray" style="background-size:20px 20px; background-repeat:no-repeat; background-position:right center;word-wrap:break-word;">
        	<a href="<?php echo addons_url('Forms://FormsValue/detail',array('id'=>$_GET['id']));?>" class="block black">
            填写说明
            </a>
        </div><?php endif; endif; ?>
    	<div class="block_content_bg m_10"> 
            <div class="block_content_top_min">
                <center>请填写以下信息</center>
            </div>
        <!-- 表单 -->
        <form id="form" action="<?php echo addons_url('Forms://Wap/index');?>" method="post" class="form-horizontal p_10">

              <?php if(is_array($fields)): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if($field['is_show'] == 4): ?><input type="hidden" class="text input-large" name="<?php echo ($field["name"]); ?>" value="<?php echo I($field[name], $field[value]);?>"><?php endif; ?>
                <?php if($field['is_show'] == 1 || $field['is_show'] == 3 || ($field['is_show'] == 5 && I($field['name']) )): ?><div class="form-item cf">
                    <label class="item-label"><?php echo ($field['title']); ?><span class="check-tips">
                      <?php if(!empty($field['remark'])): ?>（<?php echo ($field['remark']); ?>）<?php endif; ?>
                      </span></label>
                    <div class="controls">
                      <?php switch($field["type"]): case "num": ?><input type="text" class="text input-medium" name="<?php echo ($field["name"]); ?>" value="<?php echo ($data[$field['name']]); ?>"><?php break;?>
                        <?php case "string": ?><input type="text" class="text input-large" name="<?php echo ($field["name"]); ?>" value="<?php echo ($data[$field['name']]); ?>"><?php break;?>
                        <?php case "textarea": ?><label class="textarea input-large">
                            <textarea name="<?php echo ($field["name"]); ?>"><?php echo ($data[$field['name']]); ?></textarea>
                          </label><?php break;?>
                        <?php case "datetime": ?><input type="text" name="<?php echo ($field["name"]); ?>" class="text input-large time" value="<?php echo (time_format($data[$field['name']])); ?>" placeholder="请选择时间" /><?php break;?>
                        <?php case "bool": ?><select name="<?php echo ($field["name"]); ?>">
                            <?php $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" 
                              <?php if(($data[$field['name']]) == $key): ?>selected<?php endif; ?>
                              ><?php echo ($vo); ?>
                              </option><?php endforeach; endif; else: echo "" ;endif; ?>
                          </select><?php break;?>
                        <?php case "select": ?><select name="<?php echo ($field["name"]); ?>">
                            <?php $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" 
                              <?php if(($data[$field['name']]) == $key): ?>selected<?php endif; ?>
                              ><?php echo ($vo); ?>
                              </option><?php endforeach; endif; else: echo "" ;endif; ?>
                          </select><?php break;?>
                        <?php case "cascade": ?><div id="cascade_<?php echo ($field["name"]); ?>"></div>
                        <?php echo hook('cascade', array('name'=>$field['name'],'value'=>$data[$field['name']],'extra'=>$field['extra'])); break;?>   
                        <?php case "dynamic_select": ?><div id="dynamic_select_<?php echo ($field["name"]); ?>"></div>
                        <?php echo hook('dynamic_select', array('name'=>$field['name'],'value'=>$data[$field['name']],'extra'=>$field['extra'])); break;?>                        
                        <?php case "radio": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio"> <input type="radio" value="<?php echo ($key); ?>" name="<?php echo ($field["name"]); ?>" 
                              <?php if(($data[$field['name']]) == $key): ?>checked="checked"<?php endif; ?>
                              ><?php echo ($vo); ?> </label><?php endforeach; endif; else: echo "" ;endif; break;?>
                        <?php case "checkbox": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox"> <input type="checkbox" value="<?php echo ($key); ?>" name="<?php echo ($field["name"]); ?>[]" 
                              <?php if(in_array(($key), is_array($data[$field['name']])?$data[$field['name']]:explode(',',$data[$field['name']]))): ?>checked="checked"<?php endif; ?>
                              ><?php echo ($vo); ?> </label><?php endforeach; endif; else: echo "" ;endif; break;?>
                        <?php case "editor": ?><label class="textarea">
                            <textarea name="<?php echo ($field["name"]); ?>"><?php echo ($data[$field['name']]); ?></textarea>
                            <?php echo hook('adminArticleEdit', array('name'=>$field['name'],'value'=>$data[$field['name']]));?> </label><?php break;?>
                        <?php case "picture": ?><div class="controls">
                            <div class="upload_row muti_picture_row">
                            	
                            	<?php if(!empty($data[$field['name']])): $tempArr = explode(',',$data[$field['name']]); for($i=0;$i<count($tempArr);$i++){ echo '<div class="img_item"><em>X</em><input type="hidden" name="'.$field[name].'[]" value="'.$tempArr[$i].'"/><img src="'.get_cover_url($tempArr[$i]).'"/></div>'; } endif; ?>
                            	<a class="img_item add_btn" href="javascript:;" onClick="$.WeiPHP.wxChooseImg(this,1,'<?php echo ($field["name"]); ?>[]')"><img src="/Public/Home/images/add.png"/></a>
                            </div>
                          </div><?php break;?>
                        <?php case "file": ?><div class="controls">
                            <input type="file" id="upload_file_<?php echo ($field["name"]); ?>">
                            <input type="hidden" name="<?php echo ($field["name"]); ?>" value="<?php echo ($data[$field['name']]); ?>"/>
                            <div class="upload-img-box">
                              <?php if(isset($data[$field['name']])): ?><div class="upload-pre-file"><span class="upload_icon_all"></span><?php echo (get_table_field($data[$field['name']],'id','name','File')); ?></div><?php endif; ?>
                            </div>
                          </div>
                          <script type="text/javascript">
								//上传图片
							    /* 初始化上传插件 */
								$("#upload_file_<?php echo ($field["name"]); ?>").uploadify({
							        "height"          : 30,
							        "swf"             : "/Public/static/uploadify/uploadify.swf",
							        "fileObjName"     : "download",
							        "buttonText"      : "上传附件",
							        "uploader"        : "<?php echo U('File/upload',array('session_id'=>session_id()));?>",
							        "width"           : 120,
							        'removeTimeout'	  : 1,
							        "onUploadSuccess" : uploadFile<?php echo ($field["name"]); ?>
							    });
								function uploadFile<?php echo ($field["name"]); ?>(file, data){
									var data = $.parseJSON(data);
							        if(data.status){
							        	var name = "<?php echo ($field["name"]); ?>";
							        	$("input[name="+name+"]").val(data.id);
							        	$("input[name="+name+"]").parent().find('.upload-img-box').html(
							        		"<div class=\"upload-pre-file\"><span class=\"upload_icon_all\"></span>" + data.name + "</div>"
							        	);
							        } else {
							        	updateAlert(data.info);
							        	setTimeout(function(){
							                $('#top-alert').find('button').click();
							                $(that).removeClass('disabled').prop('disabled',false);
							            },1500);
							        }
							    }
								</script><?php break;?>
                        <?php default: ?>
                        <input type="text" class="text input-large" name="<?php echo ($field["name"]); ?>" value="<?php echo ($data[$field['name']]); ?>"><?php endswitch;?>
                    </div>
                  </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>

                    <div id="top-alert" class="fixed alert alert-error" style="display: none;">
  <button class="close fixed" style="margin-top: 4px;">&times;</button>
  <div class="alert-content"></div>
  </div>
          	<div class="form-item cf">
            <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
            <?php if(empty($data[id]) || $forms[can_edit]==1): ?><button class="home_btn submit-btn mb_10 mt_10" id="submit" type="button" target-form="form-horizontal">确 定</button><?php endif; ?>
            </div>
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
		title:"<?php echo ($forms["title"]); ?>",
		imgUrl:"<?php echo ($forms["cover"]); ?>",
		desc:"<?php echo ($forms["intro"]); ?>",
		link:window.location.href
	})
</script>
 <block name="script">
 <link href="<?php echo SITE_URL;?>/Public/static/datetimepicker/css/datetimepicker.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
  <?php if(C('COLOR_STYLE')=='blue_color') echo '
    <link href="<?php echo SITE_URL;?>/Public/static/datetimepicker/css/datetimepicker_blue.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
    '; ?>
  <link href="<?php echo SITE_URL;?>/Public/static/datetimepicker/css/dropdown.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?php echo SITE_URL;?>/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script> 
  <script type="text/javascript" src="<?php echo SITE_URL;?>/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=<?php echo SITE_VERSION;?>" charset="UTF-8"></script>
<script type="text/javascript">
$('#submit').click(function(){
   // $('#form').submit();
   $.Dialog.loading();
   $.ajax({
// 	   url:'<?php echo U('add?model='.$model['id']);?>',
	   url:"<?php echo addons_url('Forms://Wap/index');?>",
	   type:'post',
	   data:$('#form').serializeArray(),
	   dataType:'json',
	   success:function(json){
		    //$.Dialog.close();
			if(json.status==1){
			   		
			   		$.Dialog.success(json.info);
					//alert('2');
			   }else{
				   	$.Dialog.fail(json.info);
					//alert('3');
			}
		   if(json.url!=""){
			   setTimeout(function(){
				   window.location.href=json.url;
				   },2000);
			   }
   		},
		error:function(){
				$.Dialog.close();
			 //$.Dialog.fail();
			}
	   });
});

$(function(){
       $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:0,
        autoclose:true
    });

});
</script> 
</body>
</html>