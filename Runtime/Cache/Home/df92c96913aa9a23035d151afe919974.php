<?php if (!defined('THINK_PATH')) exit(); if(is_array($goods_list)): $i = 0; $__LIST__ = $goods_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="contentItem" data-lastid="<?php echo ($vo["id"]); ?>"> <a href="<?php echo U('detail',array('shop_id'=>$shop_id,'id'=>$vo['id']));?>"> <img src="<?php echo (get_cover_url($vo["cover"])); ?>"/>
    <div class="desc">
      <p class="name"><?php echo ($vo["title"]); ?></p>
      <p class="price">￥<?php echo (wp_money_format($vo["price"])); ?></p>
    </div>
    </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>