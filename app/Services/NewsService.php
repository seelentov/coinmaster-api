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
        $query["search"] = isset($query["search"]) ? urlencode($query["search"]) : "";
        $query["page_size"] = isset($query["page_size"]) ? urlencode($query["page_size"]) : "";
        $query["page"] = isset($query["page"]) ? urlencode($query["page"]) : "";

        return $query;
    }

    public function getNewsList($query)
    {
        $query = $this->encodedQuery($query);

        $url = "https://www.google.com/search?q={$query['search']}&tbm=nws&tbs=sbd:1&num={$query['page_size']}&start={$query['page']}&sort=p";

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
}
