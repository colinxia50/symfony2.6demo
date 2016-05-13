$( window ).on( "load", function(){
    waterfall('main','pin');
    var pid = 3; //此值为数据库查询的偏移量 代替分页
    //$.cookie('the_cookie', 'ok'); 
    window.onscroll=function(){
    	console.log(checkscrollside());
        if(checkscrollside()){
        	//setTimeout(console.log('延时'),1000);这个函数只会延迟console.log的执行
        	//并不能延迟下面的程序执行 真心玩不了 就这样了 好多bug 真的

        	//
            $.ajax({  
                type: "POST",  
                dataType: 'json',  
                url: "xcx_isdoc/ajaxget",
                data: {  
                id: pid,
                },   
                success: function(data){
             	   //console.log(datas);
                	if(typeof(data.doc=='')){
                		window.xox = 'xxx'; //不要cookie了 还是全局变量 反正都一样解决不了bug
                		//$.cookie('the_cookie', '', { expires: -1 }); // 删除 cookie
                		//$.cookie('the_cookie', 'NO');
                		
         	    	     $("#myModalLabel").text('已到最后的内容了!');
         	    	     //$("#msg").append("<small>浏览到尽头了！</small>");
         	    	     $("#msg").text("浏览到尽头了！");
         	    	     //$('#myModal').modal('toogle');
         	    	     $('#myModal').modal('show');
         	    	    //setTimeout(window.xox = 'xxx',1000);
         	    	    
                	}
                   $.each( data.doc, function( index, value ){ //看了这里的代码 我也是服了我自己
                       var $oPin = $('<div>').addClass('pin').appendTo( $( "#main" ) );
                       var $oBox = $('<div>').addClass('boxx').appendTo( $oPin );
                      // var hp = '<p class="text-center">怎样的爱情</p>';
                       
                       $('<h2>').addClass('text-center').attr('id',(value.id)).text(value.position).appendTo($oBox);
                       //$('<small>').text(value.createdat).appendTo($oBox);
                       $('h2#'+(value.id)).after('<small>日期：<cite title="Source Title">'+value.created_at.date+'</cite></small>'); 
                       $('<p>').addClass('text-success').text(value.description.substring(0,300)).appendTo($oBox);
                       if(value.description.length >300){
                    	   $('<a>').attr('href','/xcx_isdoc/' + (value.id)+'/show' ).text('[查看]').appendTo($oBox);
                       }
                       
                   });
                	
                   waterfall();
  
                                 }  
                         });
            pid =pid + 3;

        };
    }
});

/*
    parend 父级id
    pin 元素id
*/
function waterfall(parent,pin){
    var $aPin = $( "#main>div" );
    var iPinW = $aPin.eq( 0 ).outerWidth();// 一个块框pin的宽
    var num = Math.floor( $( window ).width() / iPinW );//每行中能容纳的pin个数【窗口宽度除以一个块框宽度】
    //oParent.style.cssText='width:'+iPinW*num+'px;ma rgin:0 auto;';//设置父级居中样式：定宽+自动水平外边距
    $( "#main" ).css({
        'width:' : iPinW * num,
        'margin': '0 auto'
    });

    var pinHArr=[];//用于存储 每列中的所有块框相加的高度。

    $aPin.each( function( index, value ){
        var pinH = $aPin.eq( index ).height();
        if( index < num ){
            pinHArr[ index ] = pinH; //第一行中的num个块框pin 先添加进数组pinHArr
        }else{
            var minH = Math.min.apply( null, pinHArr );//数组pinHArr中的最小值minH
            var minHIndex = $.inArray( minH, pinHArr );
            $( value ).css({
                'position': 'absolute',
                'top': minH + 'px',
                'left': minHIndex *iPinW+'px'
            });
            //数组 最小高元素的高 + 添加上的aPin[i]块框高
            pinHArr[ minHIndex ] += $aPin.eq( index ).outerHeight();//更新添加了块框后的列高
        }
    });
}

function checkscrollside(){
    var $aPin = $( "#main>div" );
    var lastPinH = $aPin.last().get(0).offsetTop + Math.floor($aPin.last().height()/2);//创建【触发添加块框函数waterfall()】的高度：最后一个块框的距离网页顶部+自身高的一半(实现未滚到底就开始加载)
    var scrollTop = $( window ).scrollTop()//注意解决兼容性
    var documentH = $( document ).width();//页面高度
    //console.log($.cookie('the_cookie'));
    if(typeof(xox) !== "undefined"){
    	return false;
    }else{
    return (lastPinH+1500 < scrollTop + documentH ) ? true : false;//到达指定高度后 返回true，触发waterfall()函数
    }
}

/*
获取胡言

*/
function ajaxgettxt(pid){
    $.ajax({  
           type: "POST",  
           dataType: 'json',  
           url: "ajaxget", 
           data: {  
           id: pid,
           },   
           success: function(data){
        	   window.datas = eval(data)
        	   console.log(datas);


	    	   //  $("#myModalLabel").text(data.doc.position);
	    	   //  $("#msg").append("<small>这是真的。你bb成功了！</small>");
	    	  //   $('#myModal').modal('toogle');
	    	    // $('#myModal').modal('show'); 
                            }  
                    });
}
/*
form表单数据转换成键值对

*/
function getFormJson(form) {
	var o = {};
	var a = $(form).serializeArray();
	$.each(a, function () {
	if (o[this.name] !== undefined) {
	if (!o[this.name].push) {
	o[this.name] = [o[this.name]];
	}
	o[this.name].push(this.value || '');
	} else {
	o[this.name] = this.value || '';
	}
	});
	return o;
	}

/*
提交胡话

*/
function ajaxsubmittxt(){
	
	$('.collapse').collapse('hide')
	
		   // $.ajax({
		     //url: "www.baidu.com",
		    // dataType: 'json',
		   //  data:getFormJson($("#isdoc")),
		    // success: function (strValue) {
		      //if (3>2) {//注意是True,不是true
		    	     $("#myModalLabel").text("插进去了！");
		    	     $("#msg").append("<small>这是真的。你bb成功了！</small>");
		    	  //   $('#myModal').modal('toogle');
		    	     $('#myModal').modal('show');
		     // }
		    //  else {
		    //	     $("#myModalLabel").text("插得不够深！失败了。");
		    //	     $("#msg").append("<small>你他娘别瞎搞！发布失败！</small>");
		    //	     $('#myModal').modal('toogle');
		    	    // $('#myModal').modal('show');
		    	     

		  //    }
		    // }
		   // })


}