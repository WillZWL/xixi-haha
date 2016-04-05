<!DOCTYPE HTML>
<html>
<head>
<meta charset='utf-8'>
<title>嘻嘻&nbsp;(*^_^*)&nbsp;哈哈</title>
<link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/publish.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<style type="text/css">
.contact-form-row {
    margin-top: 20px;
}
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
<div id='wall'>
    <div class="contact-form-row">
        @include('flash::message')
    </div>
    <ul>
        @foreach ($articles as $article)
            <li>
                <a href="">
                    <h2>{{ $article['title'] }}</h2>
                    <p>{{ $article['body'] }}</p>
                    <span>时间: {{ $article['created_at'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
    <div>
        <input class="btn btn-lg btn-success btn-block" type="button" value="投稿" data-toggle="modal" data-target="#modal-folder-create">
    </div>
</div>
<div class="modal fade" id="modal-folder-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="/publish/index" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">嘻嘻(*^_^*)哈哈</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_title" class="col-sm-3 control-label">
                            标题：
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="new_title" name="title" class="form-control" placeholder="请输入标题" notEmpty>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-sm-3 control-label">
                            内容：
                        </label>
                        <div class="col-sm-8">
                            <textarea name="body" class="form-control" placeholder="请输入正文内容" notEmpty></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_title" class="col-sm-3 control-label">
                            昵称：
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="new_title" name="username" class="form-control" placeholder="请输入昵称">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <input type="submit" class="btn btn-primary" value="提交">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>