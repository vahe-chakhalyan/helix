<?php

namespace App\Console\Commands;

use App\Article;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class GrabData extends Command
{
    const NEWS_URL = 'http://www.tert.am/am/news/';
    const BASE_URL = 'http://www.tert.am';
    const IMAGES_PATH = 'news_images';
    const ARTICLES_COUNT = 1000;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:grab_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab data from www.tert.am';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        libxml_use_internal_errors(true);
        $this->console_log('Started Grabbing Data From www.tert.am', null, 'blue', 'bold');
        $this->create_images_folder(self::IMAGES_PATH);
        Article::truncate();

        $page = 1;
        $articles_count = 0;

        while (true) {
            $this->console_log('Get News List For Page ' . $page, 'green');
            $this->console_log(self::NEWS_URL . $page, null, null, 'underlined');
            $news_list_page = $this->execute_curl(self::NEWS_URL . $page);

            if (empty($news_list_page['error'])) {
                $dom = $this->get_dom($news_list_page['result']);
                $short_news_array = $this->get_short_news($dom);

                $this->console_log('Grab Article Data', 'green', null, 'italic');
                foreach ($short_news_array as $single) {
                    $article_data = $this->get_article_data($single);

                    if ($article_data) {
                        Article::create($article_data);
                        $articles_count++;
                        if ($articles_count == self::ARTICLES_COUNT) {
                            $this->console_log('Ended Grabbing Data From www.tert.am', null, 'blue', 'bold');
                            return false;
                        }
                    }
                }
            } else {
                $this->console_log($news_list_page['error'], 'red');
                $this->log_error($news_list_page['error']);
            }

            $page++;
        }

        return false;
    }

    private function store_image($content)
    {
        $image_src = $content->getElementsByTagName('img')->item(0)->getAttribute("src");
        $filename = basename($image_src);
        Image::make($image_src)->save(public_path(self::IMAGES_PATH . '/' . $filename));

        return $image_src;
    }

    public function get_article_data($single)
    {

        $article_attributes = [];
        $article_attributes['title'] = trim($single->getElementsByTagName('h4')->item(0)->nodeValue);
        $article_attributes['url'] = $single->getElementsByTagName('a')->item(0)->getAttribute('href');

        $time = trim(explode('•', $single->getElementsByTagName('p')->item(0)->nodeValue)[0]);
        $date = trim(explode('•', $single->getElementsByTagName('p')->item(0)->nodeValue)[1]);

        $article_attributes['date'] = Carbon::createFromFormat('d.m.y H:i', $date . ' ' . $time)
            ->format('Y-m-d H:i:s');


        $article_attributes = $this->parse_article_page($article_attributes);

        return $article_attributes;
    }

    public function parse_article_page($article_attributes)
    {
        $this->console_log($article_attributes['url'], null, null, 'underlined');
        $article_page = $this->execute_curl($article_attributes['url']);
        if (empty($article_page['error'])) {
            $dom = $this->get_dom($article_page['result']);
            $content = $dom->getElementById('i-content');
            $image_path = $this->store_image($content);

            $paragraphs = $content->getElementsByTagName('p');
            $description = '';
            foreach ($paragraphs as $paragraph) {
                $description .= $paragraph->textContent . PHP_EOL;
            }

            $article_attributes['description'] = trim($description);
            $article_attributes['image_url'] = $image_path;

            return $article_attributes;

        } else {
            $this->console_log($article_page['error']);
            $this->log_error($article_page['error']);

            return false;
        }
    }

    public function get_short_news($dom)
    {
        $finder = new \DOMXPath($dom);
        $class = "news-blocks";
        $short_news = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $class ')]");

        return $short_news;
    }

    public function execute_curl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);


        $result = empty(curl_error($curl)) ? ['result' => $output] : ['error' => curl_error($curl)];

        curl_close($curl);

        return $result;
    }

    public function get_dom($result)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($result);
        $dom->preserveWhiteSpace = false;

        return $dom;
    }

    public function console_log($string = null, $color = null, $background = null, $style = null)
    {
        echo terminal_style($string, $color, $background, $style) . PHP_EOL;
    }

    public function create_images_folder($path)
    {
        $this->console_log('Created Images Folder', 'blue');
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), $mode = 0777, true, true);
        }
    }

    public function log_error($error)
    {
        $log_file = storage_path('logs/grab.log');
        $monolog = new Logger('log');
        $monolog->pushHandler(new StreamHandler($log_file), Logger::INFO);
        $monolog->error($error);
    }
}
