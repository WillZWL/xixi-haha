<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>嘻嘻&nbsp;(*^_^*)&nbsp;哈哈 — 幽默笑话，内涵段子， 尽在嘻嘻哈哈</title>
<meta name="keywords" content="嘻嘻哈哈, 幽默笑话，内涵段子，趣闻，搞笑">
<link href="./css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="./js/jquery.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
window.onload = function(){
	PBL('wrap','box');
	var ajax_data = [];
	var j = 1;
	window.onscroll = function() {
		if (j > 100) {
		} else {
			scroll();
		}
	}
	function scroll(){
		if(getCheck()){
			$.get("api", { 'page':j }, function(data, status){
				if (data.status == 'failed') {
					ajax_data = '';
					if (j > 5) {
						footer();
					}
				} else {
					ajax_data = data.data;
				}
			});
			var wrap = document.getElementById('wrap');
			var x = 0;
			var random = 0;
			for(i in ajax_data){
				//创建box
				var box = document.createElement('div');
				box.className = 'box';
				wrap.appendChild(box);
				//创建info
				var info = document.createElement('div');
				info.className = 'info';
				box.appendChild(info);
				//创建title
				var title = document.createElement('div');
				title.className = 'title';
				info.appendChild(title);
				//创建a标记
				var a = document.createElement('a');
				var pic = document.createElement('div');
				pic.className = 'pic';
				info.appendChild(pic);
				if (x == 19) {
					a.innerHTML = '下面更多精彩';
					title.appendChild(a);
					random = Math.floor((Math.random() * 10) + 1);
					var img = document.createElement('img');
    				img.src = 'images/'+random+'.jpg';
    				img.style.height = 'auto';
    				pic.appendChild(img);
				} else if ((x * j) % 50 == 1 ) {
					a.innerHTML = '扫一扫';
					title.appendChild(a);
					var img = document.createElement('img');
    				img.src = 'images/wechat.png';
    				img.style.height = 'auto';
    				pic.appendChild(img);
				} else {
					a.innerHTML = ajax_data[i].title;
					title.appendChild(a);
					var p = document.createElement('p');
					p.innerHTML = ajax_data[i].body;
					p.style.height = 'auto';
					pic.appendChild(p);
				}
				x++;
			}
			PBL('wrap','box');
			j++;
		}
	}
}

function footer() {
	var f_top = getLastH();
	f_top = f_top + 250;
	$('.footer').css({
		'display':'block',
		'top':f_top+'px',
	});
}
function PBL(wrap,box){
	var wrap = document.getElementById(wrap);
	var boxs  = getClass(wrap,box);
	var boxW = boxs[0].offsetWidth;
	var colsNum = Math.floor(document.documentElement.clientWidth/boxW);
	wrap.style.width = boxW*colsNum+'px';//为外层赋值宽度
	var everyH = [];//定义一个数组存储每一列的高度
	for (var i = 0; i < boxs.length; i++) {
		if(i<colsNum){
			everyH[i] = boxs[i].offsetHeight;
		}else{
			var minH = Math.min.apply(null,everyH);//获得最小的列的高度
			var minIndex = getIndex(minH,everyH); //获得最小列的索引
			getStyle(boxs[i],minH,boxs[minIndex].offsetLeft,i);
			everyH[minIndex] += boxs[i].offsetHeight;//更新最小列的高度
		}
	}
}
function getClass(wrap,className){
	var obj = wrap.getElementsByTagName('*');
	var arr = [];
	for(var i=0;i<obj.length;i++){
		if(obj[i].className == className){
			arr.push(obj[i]);
		}
	}
	return arr;
}
function getIndex(minH,everyH){
	for(index in everyH){
		if (everyH[index] == minH ) return index;
	}
}
function getCheck(){
	var documentH = document.documentElement.clientHeight;
	var scrollH = document.documentElement.scrollTop || document.body.scrollTop;
	return documentH+scrollH>=getLastH() ?true:false;
}
function getLastH(){
	var wrap = document.getElementById('wrap');
	var boxs = getClass(wrap,'box');
	return boxs[boxs.length-1].offsetTop+boxs[boxs.length-1].offsetHeight;
}

var getStartNum = 0;//设置请求加载的条数的位置
function getStyle(box,top,left,index){
    if (getStartNum>=index) return;
    $(box).css({
    	'position':'absolute',
        'top':top,
        "left":left,
        "opacity":"0"
    });
    $(box).stop().animate({
        "opacity":"1"
    },999);
    getStartNum = index;//更新请求数据的条数位置
	$("#title").find('img').remove();
}
</script>


<style type="text/css">
	.notice {
		color: #e6a549;
	}
	#goTop{position:absolute;display:none;width:50px;height:48px;background:#fff url(images/gotop.png) no-repeat 16px 15px;border:solid 1px #f9f9f8;border-radius:6px;box-shadow:0 1px 1px rgba(0, 0, 0, 0.2);cursor:pointer}
	#goTop:hover{height:50px;background-position:16px 16px;box-shadow:0 1px 1px rgba(0, 0, 0, 0.3)}
</style>
</head>
<body>
<div class="header">
	<div class="nav">
		<h2 class="notice">XiXi-HaHa</h2>
		<ul class="nav-r">
			<li><a href="http://willzhangweilin.com/abouts">关于</a></li>
			<li><a href="http://willzhangweilin.com/contact">联系</a></li>
			<li><a href="/publish">投稿</a></li>
		</ul>
	</div>
</div>
<section id="title">
	<h2>嘻嘻&nbsp;(*^_^*)&nbsp;哈哈
	<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1258409999'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1258409999%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
	</h2>
</section>
<div id="wrap">
	<div class="box">
    	<div class="info">
	    	<div class="title"><a href="#">往下有福利图,老司机懂</a></div>
            <div class="pic"><img src="images/{{ rand(1, 10) }}.jpg"></div>
    	</div>
    </div>
    @foreach ($articles as $k => $article)
    <div class="box">
    	<div class="info">
	    	<div class="title">{{ $article['title'] }}</div>
            <div class="pic">
            	<p>{{ $article['body'] }}</p>
            </div>
    	</div>
    </div>
    @endforeach
</div>
<div class="footer">
    <div class="container">
        <div class="clearfix"></div>
        <div class="bottom">
            <p>Copyright &copy; 2016-2018.Will All rights reserved.<a href="http://www.miitbeian.gov.cn">鄂ICP备16004814号 </a>
            <br/>
            Developed By <a href="/abouts" target="_blank">Will Zhang</a>,&nbsp;Powered By <a href="https://laravel.com/">Laravel</a>&nbsp;&&&nbsp;<a href="http://getbootstrap.com/">Bootstrap</a><br/>
            Run On <a href="https://www.aliyun.com">Aliyun's</a> Elastic Compute Service
        </div>
    </div>
</div>
<div id="goTop" class="goTop"></div>
<script type="text/javascript">
    $(window).scroll(function(){
        var sc=$(window).scrollTop();
        var rwidth=$(window).width()+$(document).scrollLeft();
        var rheight=$(window).height()+$(document).scrollTop();
        if(sc>0){
            $("#goTop").css("display","block");
            $("#goTop").css("left",(rwidth-80)+"px");
            $("#goTop").css("top",(rheight-120)+"px");
        }else{
            $("#goTop").css("display","none");
        }
    });
    $("#goTop").click(function(){
        $('body,html').animate({scrollTop:0},300);
    });
</script>
</body>
</html>