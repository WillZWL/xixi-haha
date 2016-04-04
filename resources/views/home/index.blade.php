<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>嘻嘻哈哈(By Will.)</title>
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
			// to do footer

		} else {
			scroll();
		}
	}

	function scroll(){
		if(getCheck()){
			$.post("ajaxData", { 'page':j }, function(data, status){
				ajax_data = data;
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
}
</script>
<style type="text/css">
	.notice {
		color: #e6a549;
	}
</style>
</head>
<body>
<div class="header">
	<div class="nav">
		<h2 class="notice">XiXi-HaHa</h2>
		<ul class="nav-r">
			<li><a href="http://willzhangweilin.com/abouts">About</a></li>
			<li><a href="http://willzhangweilin.com/contact">Contact</a></li>
		</ul>
	</div>
</div>
<section id="title">
	<h2>嘻嘻&nbsp;(*^_^*)&nbsp;哈哈</h2>
</section>
<div id="wrap">
	<div class="box">
    	<div class="info">
	    	<div class="title"><a href="#">往下有福利图,老司机懂</a></div>
            <div class="pic"><img src="images/{{ rand(1, 10) }}.jpg"></div>
    	</div>
    </div>
	<div class="box">
	<div class="info">
    	<div class="title"><a class="notice" href="http://willzhangweilin.com/contact">号外！投稿领红包啦</a></div>
        <div class="pic">
        	<p>
        		号外！号外！号外！(*^_^*) 如果你有好玩有趣的段子，独乐乐， 不如众乐乐， 分享，让快乐传递，让大家一起来<span class="">嘻嘻哈哈</span>。<a class="notice" href="http://willzhangweilin.com/contact">欢迎来稿</a>，趣闻段子一经采用, 每周按段子热度排名，前十的优秀趣闻段子将有机会领取微信红包哦。
        	</p>
        </div>
	</div>
    </div>
    @foreach ($articles as $k => $article)
    <div class="box">
    	<div class="info">
	    	<div class="title">{{ $article->title }}</div>
            <div class="pic">
            	<p>{{ $article->body }}</p>
            </div>
    	</div>
    </div>
    @endforeach
</div>
</body>
</html>