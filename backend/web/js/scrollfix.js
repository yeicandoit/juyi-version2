// JavaScript Document
(function($) {
    //URI:http://caibaojian.com/scrollfix
    //author:caibaojian
    //website:http://caibaojian.com
    //descirption:scroll and fixed some div
    $.fn.scrollFix = function(options) {
        return this.each(function() {

            var opts = $.extend({}, $.fn.scrollFix.defaultOptions, options);
            var obj = $(this),
                base = this,
                selfTop = 0,
                selfLeft = 0,
                toTop = 0,
                parentOffsetLeft = 0,
                parentOffsetTop = 0,
                outerHeight,
                outerWidth,
                objWidth = 0,
                placeholder = jQuery('<div>'), //閸掓稑缂撴稉鈧稉鐚╭uery鐎电钖�
                optsTop = opts.distanceTop, //鐎规矮绠熼崚浼淬€婇柈銊ф畱妤傛ê瀹�
                endfix = 0; //瀵偓婵浠犲銏犳祼鐎规氨娈戞担宥囩枂

            var originalPosition;
            var originalOffsetTop;
            var originalZIndex;
            var lastOffsetLeft = -1;
            var isUnfixed = true;
            //婵″倹鐏夊▽鈩冩箒閹垫儳鍩岄懞鍌滃仯閿涘奔绗夋潻娑滎攽婢跺嫮鎮�
            if (obj.length <= 0) {
                return;
            }
            if (lastOffsetLeft == -1) {
                originalZIndex = obj.css('z-index');
                position = obj.css('position');
                originalPosition = obj.css('position');

                originalOffsetTop = obj.css('top');
            }

            var zIndex = obj.css('zIndex');
            if (opts.zIndex != 0) {
                zIndex = opts.zIndex;
            }
            //閼惧嘲褰囬惄绋款嚠鐎规矮缍呴幋鏍偓鍛卜鐎电懓鐣炬担宥囨畱閻栧墎琚�
            var parents = obj.parent();
            var Position = parents.css('position');
            while (!/^relative|absolute$/i.test(Position)) { //濡偓濞村璇為崝銊ュ帗缁辩姷娈戦悥鍓佽閸忓啰绀岀€规矮缍呮稉锟�'relative'閹存牞鈧拷'absolute',閺勵垳娈戠拠婵嬧偓鈧崙鐚寸礉閸氾箑鍨惃鍕樈閿涘本澧界悰灞芥儕閻滎垽绱濈紒褏鐢荤€电粯澹樼€瑰啰娈戦悥鍓佽
                parents = parents.parent();
                Position = parents.css('position');
                if (/^body|html$/i.test(parents[0].tagName)) break; //閸嬪洤顩ч悥鍓佽閸忓啰绀岄惃鍕垼缁涘彞璐焍ody閹存牞鈧専TML閿涘矁顕╅弰搴㈢梾閺堝澹橀崚鎵煑缁璐熸禒銉ょ瑐閻ㄥ嫬鐣炬担宥忕礉闁偓閸戝搫鎯婇悳锟�
            }

            var ie6 = !-[1, ] && !window.XMLHttpRequest; //閸忕厧顔怚E6
            var resizeWindow = false;

            function resetScroll() {
                setUnfixed();
                selfTop = obj.offset().top; //鐎电钖勭捄婵堫瀲妞ゅ爼鍎存妯哄
                selfLeft = obj.offset().left; //鐎电钖勭捄婵堫瀲瀹革箒绔熺€硅棄瀹�
                outerHeight = obj.outerHeight(); //鐎电钖勬妯哄
                outerHeight = parseFloat(outerHeight) + parseFloat(obj.css('marginBottom').replace(/auto/, 0));
                outerWidth = obj.outerWidth(); //鐎电钖勬径鏍ь啍鎼达拷
                objWidth = obj.width();
                var documentHeight = $(document).height(); //閺傚洦銆傛妯哄
                var startTop = $(opts.startTop), //瀵偓婵璇為崝銊ユ祼鐎规艾顕挒锟�
                    startBottom = $(opts.startBottom),
                    toBottom, //閸嬫粍顒涘⿰姘З娴ｅ秶鐤嗙捄婵堫瀲鎼存洟鍎撮惃鍕彯鎼达拷
                    ScrollHeight; //鐎电钖勫⿰姘З閻ㄥ嫰鐝惔锟�

                //鐠侊紕鐣婚悥鍓佽閸嬪繒些閸婏拷
                if (/^body|html$/i.test(parents[0].tagName)) { //瑜版挾鍩楃猾璇插帗缁辩娀娼猙ody閹存牞鈧専TML閺冭绱濈拠瀛樻閹垫儳鍩屾禍鍡曠娑擃亞鍩楃猾璁宠礋'relative'閹存牞鈧拷'absolute'閻ㄥ嫬鍘撶槐鐙呯礉瀵版鍤€瑰啰娈戦崑蹇曅╂妯哄
                    parentOffsetTop = 0, parentOffsetLeft = 0;
                } else {
                    parentOffsetLeft = parents.offset().left, parentOffsetTop = parents.offset().top;
                }

                // 鐠侊紕鐣婚悥鎯板Ν閻愬湱娈戞稉濠呯珶閸掍即銆婇柈銊ㄧ獩缁傦拷
                // 婵″倹鐏� body 閺堬拷 top 鐏炵偞鈧拷, 濞戝牓娅庢潻娆庣昂娴ｅ秶些
                var bodyToTop = parseInt(jQuery('body').css('top'), 10);
                if (!isNaN(bodyToTop)) {
                    optsTop += bodyToTop;
                }
                //鐠侊紕鐣婚崑婊冩躬鎼存洟鍎撮惃鍕獩缁傦拷
                if (!isNaN(opts.endPos)) {
                    toBottom = opts.endPos;
                } else {
                    toBottom = parseFloat(documentHeight - $(opts.endPos).offset().top);
                }
                //鐠侊紕鐣婚棁鈧憰浣圭泊閸斻劎娈戞妯哄娴犮儱寮烽崑婊勵剾濠婃艾濮╅惃鍕彯鎼达拷
                ScrollHeight = parseFloat(documentHeight - toBottom - optsTop), endfix = parseFloat(ScrollHeight - outerHeight);
                //鐠侊紕鐣绘い鍫曞劥閻ㄥ嫯绐涚粋璇测偓锟�
                if (startTop[0]) {
                    var startTopOffset = startTop.offset(),
                        startTopPos = startTopOffset.top;
                    selfTop = startTopPos;
                }
                if (startBottom[0]) {
                    var startBottomOffset = startBottom.offset(),
                        startBottomPos = startBottomOffset.top,
                        startBottomHeight = startBottom.outerHeight();
                    selfTop = parseFloat(startBottomPos + startBottomHeight);
                }

                toTop = selfTop - optsTop;
                toTop = (toTop > 0) ? toTop : 0;

                var selfBottom = documentHeight - selfTop - outerHeight;
                //婵″倹鐏夊⿰姘З閸嬫粌婀惔鏇㈠劥閻ㄥ嫬鈧棿绗夋稉锟�0閿涘苯鑻熸稉鏃囧殰闊偄鍩屾惔鏇㈠劥閻ㄥ嫰鐝惔锕€鐨禍搴濈瑐闂堛垼绻栨稉顏勨偓纭风礉娑撳秵澧界悰灞捐癁閸斻劌娴愮€癸拷
                if ((toBottom != 0) && (selfBottom <= toBottom)) {
                    return;
                }

            }
            function setUnfixed() {
                if (!isUnfixed) {
                    lastOffsetLeft = -1;
                    placeholder.css("display", "none");
                    obj.css({
                        'z-index': originalZIndex,
                        'width': '',
                        'position': originalPosition,
                        'left': '',
                        'top': originalOffsetTop,
                        'margin-left': ''
                    });
                    obj.removeClass('scrollfixed');
                    isUnfixed = true;
                }
            }

            function onScroll() {
                lastOffsetLeft = 1;
                var ScrollTop = $(window).scrollTop();
                if (opts.bottom != -1) {
                    ScrollTop = ScrollTop + $(window).height() - outerHeight - opts.bottom;
                }
                if (ScrollTop > toTop && (ScrollTop < endfix)) {
                    if (ie6) { //IE6閸掓瑤濞囬悽銊ㄧ箹娑擃亝鐗卞锟�
                        obj.addClass(opts.baseClassName).css({
                            "z-index": zIndex,
                            "position": "absolute",
                            "top": opts.bottom == -1 ? ScrollTop + optsTop - parentOffsetTop : ScrollTop - parentOffsetTop,
                            "bottom": 'auto',
                            "left": selfLeft - parentOffsetLeft,
                            'width': objWidth
                        })
                    } else {
                        obj.addClass(opts.baseClassName).css({
                            "z-index": zIndex,
                            "position": "fixed",
                            "top": opts.bottom == -1 ? optsTop : '',
                            "bottom": opts.bottom == -1 ? '' : opts.bottom,
                            "left": selfLeft,
                            "width": objWidth
                        });
                    }
                    placeholder.css({
                        'height': outerHeight,
                        'width': outerWidth,
                        'display': 'block'
                    }).insertBefore(obj);
                } else if (ScrollTop >= endfix) {
                    obj.addClass(opts.baseClassName).css({
                        "z-index": zIndex,
                        "position": "absolute",
                        "top": endfix - parentOffsetTop + optsTop,
                        'bottom': '',
                        "left": selfLeft - parentOffsetLeft,
                        "width": objWidth
                    });
                    placeholder.css({
                        'height': outerHeight,
                        'width': outerWidth,
                        'display': 'block'
                    }).insertBefore(obj)
                } else {
                    obj.removeClass(opts.baseClassName).css({
                        "z-index": originalZIndex,
                        "position": "static",
                        "top": "",
                        "bottom": "",
                        "left": ""
                    });
                    placeholder.remove()
                }
            }
            var Timer = 0;
            // if (isUnfixed) {
            resetScroll();
            // }
            $(window).on("scroll", function() {
                if (Timer) {
                    clearTimeout(Timer);
                }
                Timer = setTimeout(onScroll, 0);
            });
            // 瑜版挸褰傞悳鎷岀殶閺佹潙鐫嗛獮鏇炪亣鐏忓繑妞傞敍宀勫櫢閺傜増澧界悰灞煎敩閻拷
            $(window).on("resize", function() {
                if (Timer) {
                    clearTimeout(Timer);
                }
                Timer = setTimeout(function() {
                    isUnfixed = false;
                    resetScroll();
                    onScroll();
                }, 0);
            });
        })
    }
    $.fn.scrollFix.defaultOptions = {
        startTop: null, //濠婃垵鍩屾潻娆庨嚋娴ｅ秶鐤嗘い鍫曞劥閺冭泛绱戞慨瀣癁閸旑煉绱濇妯款吇娑撹櫣鈹�
        startBottom: null, //濠婃垵鍩屾潻娆庨嚋娴ｅ秶鐤嗛張顐ゎ伂瀵偓婵璇為崝顭掔礉姒涙ǹ顓绘稉铏光敄
        distanceTop: 0, //閸ュ搫鐣鹃崷銊┿€婇柈銊ф畱妤傛ê瀹�
        endPos: 0, //閸嬫粓娼崷銊ョ俺闁劎娈戞担宥囩枂閿涘苯褰叉禒銉よ礋jquery鐎电钖�
        bottom: -1, //鎼存洟鍎存担宥囩枂
        zIndex: 0, //z-index閸婏拷
        baseClassName: 'scrollfixed' //瀵偓婵娴愮€规碍妞傚ǎ璇插閻ㄥ嫮琚�
    };
})(jQuery);