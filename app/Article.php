<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Article extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'body','click', 'original', 'created_at'];

    public static function getIndexData()
    {
        return \Cache::remember('xiha_index', 60, function () {
            $list = Article::latest()->take(20)->select('title', 'body')->get();
            $articles = [];
            foreach ($list as $value) {
                $row['title'] = $value->title;
                $row['body'] = str_replace("</p><p>", '', $value->body);
                $articles[] = $row;
            }
            return $articles;
        });
    }

    public function getBodyHtmlAttribute()
    {
        $Parsedown = new \Parsedown();

        return $Parsedown->text($this->body);
    }

    public function setCreatedAtAttribute($date)
    {
        if (is_string($date)) {
            $this->attributes['created_at'] = Carbon::createFromFormat('Y-m-d', $date);
        } else {
            $this->attributes['created_at'] = $date;
        }
    }
}
