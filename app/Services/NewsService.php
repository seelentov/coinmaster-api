<?php

namespace App\Services;

use App\Components\NewsClient;
use App\Services\Abstract\AbstractService;
use App\Services\Interfaces\INewsService;
use PHPHtmlParser\Dom;

class NewsService extends AbstractService implements INewsService
{
    private $dom;
    public function __construct()
    {
        $this->dom = new Dom;
    }

    private function encodedQuery($query)
    {
        if (isset($query["search"])) {
            foreach ($query["search"] as &$str) {
                $str = urlencode($str);
            }
        }

        $searchCount = isset($query["search"]) ? count($query["search"]) : 1;

        $query["search"] = isset($query["search"]) ? $query["search"] : "";
        $query["page_size"] = intval((isset($query["page_size"]) ? intval($query["page_size"]) : 10) / $searchCount);

        $query["page"] = isset($query["page"]) ? intval($query["page"]) : 1;

        return $query;
    }

    private function getNewsListSingle($search, $query)
    {
        $url = "https://www.google.com/search?q={$search}&tbm=nws&tbs=sbd:1&num={$query['page_size']}&start={$query['page']}&sort=p";

        $this->dom->loadFromUrl($url);

        $newsList = [];

        $cards = $this->dom->find('#main > div');

        foreach ($cards as $index => $card) {
            if ($index < 3) {
                continue;
            }

            $news = [];


            $titleElement = strip_tags($card->find('h3')->innerHtml);
            $news['title'] = $titleElement;

            $linkElement = $card->find('a')->getAttribute('href');
            $decodedInput = html_entity_decode($linkElement);

            $urlPart = parse_url($decodedInput, PHP_URL_QUERY);

            parse_str($urlPart, $queryParams);

            $url = isset($queryParams['url']) ? $queryParams['url'] : '';

            $news['link'] = $url;



            $dateElement = $card->find('span')->text ?? '';
            $news['date'] = $dateElement;

            $descriptionElement = str_replace($dateElement, "", strip_tags($card->find('span')->parent->innerHtml)) ?? '';
            $news['description'] = $descriptionElement;
            $newsList[] = $news;
        }

        return $newsList;
    }

    public function getNewsList($query)
    {
        $query = $this->encodedQuery($query);

        $res = [];

        foreach ($query['search'] as $search) {
            array_push($res, ...$this->getNewsListSingle($search, $query));
        }

        usort($res, function ($a, $b) {
            return $this->sortByDate($a, $b);
        });

        return $res;
    }

    private function sortByDate($a, $b)
    {
        return $this->convertStringDateToSeconds($a['date']) - $this->convertStringDateToSeconds($b['date']);
    }

    private function convertStringDateToSeconds($dateString)
    {

        $multiplierTable = [
            "мин" => 60,
            "час" => 3600,
            'дн' => 86400,
            'ден' => 86400,
            'год' => 31536000
        ];

        $multiplier = 1;

        foreach ($multiplierTable as $format => $value) {
            if (str_contains($dateString, $format)) {
                $multiplier = $value;
            }
        }

        $count = intval($dateString);

        return $count * $multiplier;
    }
}
