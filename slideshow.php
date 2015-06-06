<?php wp_reset_query(); if ( is_home()) { ?>
	<script  src="<?php bloginfo('template_url');?>/js/loopedSlider.js">// 加载幻灯片插件</script>
	<script> // 幻灯片的参数设置
      jQuery(document).ready(function($){  
            $('#loopedslider').loopedSlider({
                autoHeight: 0,
                containerClick: false,
				addPagination: 1,
				autoStart: 8000,
				restart: 2500
            })
        })
    </script>
	
<div id="slidebar"> 
	<div class="slidebg"> 
  		 <div id="loopedslider">
         	<div class="container">
    			<div class="slides">
                	<!--开始幻灯片内容 ，用div来包裹，这是第一个，注意图片大小是 730 x 230-->
                  <div>
                    <img src="<?php bloginfo('template_url');?>/example/example1.jpg" alt="例子1，只有图片"  />
                  </div>
                  
                  	<!--开始第二个幻灯片-->
                  <div>
                    <a href="#"><img src="<?php bloginfo('template_url');?>/example/example2.jpg" alt="例子2，含有链接的图片" /></a>
                  </div>
                  
                  	<!--开始第三个幻灯片-->	
                  <div>
                    <img src="<?php bloginfo('template_url');?>/example/example3.jpg" alt="例子3，图片+介绍文字" /> 
                        <span class="slidestext"> 
                          <h4>标题样式</h4>
                          例子3，图片+介绍文字<br>
                          注意要用换行符号换行<br>
                          标题h3是紫色，h4是蓝色<br>
                          PS:最大宽度300px<br>
                          超出300px自动换行，参见下一张<br>
                          <a href="#">链接</a>
                        </span>
                  </div>
                  
                  <!--开始第四个幻灯片-->	
                  <div>
                     <a href="#"> <img src="<?php bloginfo('template_url');?>/example/example4.jpg" alt="例子4，链接图片+介绍文字" /></a>		
					   <span class="slidestext"> 
							  <h3> 『EVA:破』 画面曝光</h3>
							  在公开的预告片中，虽然没有主役台词 但是由鹭巢诗郎创作的音乐缓缓流淌，加上动感十足的战斗场面依然能牢牢吸引眼球。在这个简短的预告篇中，可以看到《EVA：破》中登场的EVA2号机在空中乱舞的场面，与TV系列中有异曲同工之妙的初号机和3号机激烈战斗的场面，此外还有疑似新使徒的身影出没。<br>
							   <a href="#">猛击查看</a>  
						</span> </a>
                  </div>
                  <!--以此类推，建立新的在下面填写-->	
                  
                  
                  
                  
                  <!--以上-->	
    			</div>
  			</div>
             <span class="pre"><a href="#" class="previous">previous</a></span>
             <span class="nex"><a href="#" class="next">next</a></span>
		</div>
  </div> 
</div> 
<?php } ?>