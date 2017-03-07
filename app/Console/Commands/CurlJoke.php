<?php

namespace App\Console\Commands;

use App\Article;
use Config;
use Log;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class CurlJoke extends Command
{
    protected $name = 'joke';

    protected $description = 'Joke From Api && Cache Joke Data';

    public function __construct()
    {
        parent::__construct();
    }

    protected function getOptions()
    {
        return [
            ['create_cache', null, InputOption::VALUE_NONE, 'An create cache option.'],
        ];
    }

    public function handle()
    {
        if (!$this->option('create_cache')) {
            $this->curlApi();
        }

        $this->flushData();
        $this->cacheData();
    }

    private function cacheData()
    {
        for ($i = 1; $i <= 100; ++$i) {
            $skip = 20 * $i;
            $articles = Article::latest()->skip($skip)->take(20)->get();
            $data = array();
            $row = array();
            foreach ($articles as $k => $article) {
                $row['title'] = $article->title;
                $row['body'] = str_replace(array('<p>', '</p>'), '', $article->body);
                $data[] = $row;
            }
            $key = 'joke'.$i;
            \Cache::tags('xixihaha')->forever($key, $data);
        }
    }

    private function flushData()
    {
        for ($i = 0; $i <= 100; ++$i) {
            $key = 'joke'.$i;
            \Cache::tags('xixihaha')->forget($key);
        }
    }

    private function stroeData($data)
    {
        foreach ($data as $row) {
            $article['title'] = $row->title;
            $article['body'] = str_replace(array('<p>', '</p>'), '', $row->text);
            try {
                $result = Article::firstOrNew($article);
                if (!$result->exists) {
                    Article::create($article);
                }
            } catch (Exception $e) {
                log::info('The article duplicate');
            }
        }
    }

    private function curlApi()
    {
        for ($i = 1; $i <= 5; ++$i) {
            try {
                $curl_result = $this->curlPost($i);
                $this->stroeData($curl_result);
            } catch (Exception $e) {
                log::info('Curl Api Failed');
            }
        }
    }

    private function curlPost($page = '1')
    {
        $api_url = Config::get('app.api_url');
        $api_key = Config::get('app.api_key');
        $ch = curl_init();
        $url = $api_url.$page;
        $header = array("apikey: $api_key");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);
        $res = json_decode($res);
        if ($res->showapi_res_code == 0) {
            $list = $res->showapi_res_body->contentlist;

            return $list;
        }
    }

    public function fire()
    {
    }
}
