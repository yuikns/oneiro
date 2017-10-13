jQuery(document).ready(function($) {
    window.console.info("enjoy coding, enjoy life.");

    // for animated navigation bar
    $("#nav ul").css({display: "none"}); // Opera Fix
    $("#nav li").hover(
        function(){$(this).find('ul:first').css({visibility: "visible",display: "none"}).show(268);},
        function(){$(this).find('ul:first').fadeOut(200)});

    $("#nav a").hover(
        function(){$(this).stop().animate({marginTop:"2px"},100);},
        function(){$(this).stop().animate({marginTop:"0px"},100);});
 
    $("#nav ul a").hover(
        function(){$(this).stop().animate({marginLeft:"10px"},200);},
        function(){$(this).stop().animate({marginLeft:"0px"},200);});


    // 这个是more标签的
    $("#content a.more-link").hover(function() {
        if (!$(this).is(":animated")) {
            $(this).animate({
                left: '-6px'
            }, 210).animate({
                left: '0px'
            }, 180)
                .animate({
                    left: '-3px'
                }, 150).animate({
                    left: '0px'
                }, 130)
                .animate({
                    left: '-1px'
                }, 100).animate({
                    left: '0px'
                }, 80);
        }
    });

    //缩略图动画
    $("#content .featured-thumbnail").hover(function() {
        $(this).stop().animate({
            marginTop: "8px"
        }, 200);
    }, function() {
        $(this).stop().animate({
            marginTop: "0px"
        }, 200);
    });
    //链接高光，其实就是一个半透明加一个延时不透明
    $("#article a").hover(function() {
        if (!$(this).is(":animated")) {
            $(this).animate({
                opacity: ".6"
            }, 210).animate({
                opacity: "1"
            }, 180);
        }
    });

    //两栏目等高,为了虚线

    var _leftheight = jQuery("#content").height();
    _rightheight = jQuery("#sidebar").height();
    if (_leftheight > _rightheight) {

        $("#sidebar").height(_leftheight);
    } else {
        $("#content").height(_rightheight);
    };


    //侧边栏伸缩
    $("#sidebar h3").click(function() {
        $(this).next().slideToggle('slow')
    });


    //侧边栏开关
    //$('.showclose').toggle(function(){
    //    $(this).text("✜ 显示侧边栏")
    //    $(".layout").css({ "border-right": "none", "background": "none" },300);
    //    $('#sidebar').hide(500).prev().animate({width: "859px"}, 1000);
    //    
    //    
    //    },function(){
    //    $(this).text("♤ 关闭侧边栏")
    //    $(".layout").css({ "border-right": "1px solid #d5d5d5", "background": "#fff" },500);
    //    $('#sidebar').delay(800).slideDown(800).prev().animate({width: "640px"}, 800);
    //});
    // for 1.9+ jquery update 
    $('.showclose').on("click", function() {
        if ($(this).hasClass('showclose_extend')) {
            $(this).removeClass('showclose_extend');
            $(this).text("♤ Hide Sidebar")
            $(".layout").css({
                "border-right": "1px solid #d5d5d5",
                "background": "#fff"
            }, 500);
            $('#sidebar').delay(800).slideDown(800).prev().animate({
                // width: "640px"
                width: "73%"
            }, 800);
        } else {
            $(this).addClass('showclose_extend');
            $(this).text("✜ Show Sidebar")
            $(".layout").css({
                "border-right": "none",
                "background": "none"
            }, 300);
            $('#sidebar').hide(500).prev().animate({
                // width: "859px"
                width: "100%"
            }, 1000);
        }
    });

    //滑动定位
    $("#godown").hover(function() {
        $("#tip").fadeIn(300);
    });
    $("#godown").mouseout(function() {
        $("#tip").fadeOut(300);
    });


    $('#godown').click(function() {
        $('html,body').animate({
            scrollTop: $('#comments1').offset().top
        }, 1000);
    });


    $(window).scroll(function() { //浏览器滚动条触发事件
        $("#godown").animate({
            top: $(window).scrollTop() + 25 + "px"
        }, {
            queue: false,
            duration: 500
        });
        $("#tip").animate({
            top: $(window).scrollTop() + 21 + "px"
        }, {
            queue: false,
            duration: 500
        });
    });

    ///////////下面这个是文章图片题目提示//////////
    $(function() {
        //遍历图片；
        $('#content .post-content a img').each(function(i) {
            //如果存在 title 值，才执行下面代码；
            if (this.title) {
                //赋值获取 title 的值；
                var imgTitle = this.title;
                var x = 15;
                //鼠标滑过；标题为空值；在 body 中插入显示标题的容器，id 为 #tooltip；
                //定位 #tooltip 的显示位置并显示；
                $(this).mouseover(function(e) {
                    this.title = '';
                    $('body').append('<div id="tooltip">' + imgTitle + '</div>');
                    $('#tooltip').css({
                        'left': (e.pageX + x) + 'px',
                        'top': e.pageY + 'px'
                    }).fadeTo('opacity', 0.9);
                })
                //鼠标滑出；标题 title 值恢复；移除鼠标滑过时添加的容器 #tooltip；
                .mouseout(function() {
                    this.title = imgTitle;
                    $('#tooltip').remove();
                })
                //设置标题容器跟随鼠标移动。
                .mousemove(function(e) {
                    $('#tooltip').css({
                        'left': (e.pageX + x) + 'px',
                        'top': e.pageY + 'px'
                    });
                });
            }
        });
    });


    ////////////下面这个是特色图片题目提示/////////                

    $(window).load(function() {
        //遍历图片；
        $('#content .post-content .featured-thumbnail img').each(function(index) {

            //如果图片存在 title 属性；
            if (this.title) {
                //赋值 imgTitle 为图片的 title；
                var imgTitle = this.title;
                //去除图片 title 的值；
                this.title = '';
                //用一个 span 标签把图片包起来，并在图片后面插入一个放置图片 title 的 p 元素；
                $(this).wrap('<span id="img_wrapper"></span>').after('<p id="tooltips">' + imgTitle + '</p>');
                //图片左内边距值；
                var imgPaddingLeft = parseFloat($(this).css('paddingLeft'), 10);
                //获取图片左边框值；
                var imgBorderLeft = parseFloat($(this).css('borderLeftWidth'), 10);
                //获取图片左外边距值；
                var imgMarginLeft = parseFloat($(this).css('marginLeft'), 10);
                //获取图片下内边距值；
                var imgPaddingBottom = parseFloat($(this).css('paddingBottom'), 10);
                //获取图片下边框值；
                var imgBorderBottom = parseFloat($(this).css('borderBottomWidth'), 10);
                //获取图片下外边距值；
                var imgMarginBottom = parseFloat($(this).css('marginBottom'), 10);
                //赋值、获取标题的 left 属性值；
                var imgPositionLeft = imgPaddingLeft + imgBorderLeft + imgMarginLeft + 'px';
                //赋值、获取标题的 bottom 属性值；
                var imgPositionBottom = imgPaddingBottom + imgBorderBottom + imgMarginBottom + 'px';
                //如果图片有浮动，则把浮动去除并转移到父元素 #img_wrapper 上；
                var imgFloat = $(this).css('float');
                var $img_wrapper = $(this).parent('#img_wrapper');
                if (imgFloat !== 'none') {
                    $(this).css('float', 'none');
                    $img_wrapper.css({
                        'float': imgFloat
                    });
                }
                //获取图片的宽度；
                var imgWidth = $(this).width() + 'px';
                //赋值、获取标题的最高高度；
                var tipHeight = parseFloat($(this).height(), 10);
                tipHeight *= 0.5;
                var $tooltips = $(this).next('#tooltips');
                //设置标题 p 元素的显示位置、宽度、透明度，并隐藏；
                $tooltips
                    .css({
                        'max-height': tipHeight,
                        'width': imgWidth,
                        'left': imgPositionLeft,
                        'bottom': imgPositionBottom
                    })
                    .fadeTo('opacity', 0.8).hide();
                //鼠标滑过 #img_wrapper 时显示 title，滑出则隐藏。
                $img_wrapper.hover(function() {
                    $tooltips.fadeIn('slow');
                }, function() {
                    $tooltips.fadeOut('slow');
                });
            }
        });
    });


    //添加更多    

    // LOGO
    $('argcv').html('<span style="color:MediumPurple;">A</span><span style="color:SkyBlue;">rg</span><span style="color:Gold;">C</span><span style="color:OrangeRed;">V</span>');

});




