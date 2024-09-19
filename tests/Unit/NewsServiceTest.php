<?php

namespace Tests\Unit;

use App\Services\NewsService;
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;

class NewsServiceTest extends TestCase
{
    /** @test */
    public function it_can_get_news_list()
    {
        $newsService = new NewsService();

        $search = [
            "Австралийский доллар",
            "Азербайджанский манат",
            "Армянский драм",
            "Белорусский рубль",
            "Болгарский лев",
            "Бразильский реал",
            "Венгерский форинт",
            "Вон Республики Корея",
            "Вьетнамский донг",
            "Гонконгский доллар",
            "Грузинский лари",
            "Датская крона",
            "Дирхам ОАЭ",
            "Доллар США",
            "Евро",
            "Египетский фунт",
            "Индийская рупия",
            "Индонезийская рупия",
            "Казахстанский тенге",
            "Канадский доллар",
            "Катарский риал",
            "Киргизский сом",
            "Китайский юань",
            "Молдавский лей",
            "Новозеландский доллар",
            "Новый туркменский манат",
            "Норвежская крона",
            "Польский злотый",
            "Румынский лей",
            "СДР (специальные права заимствования)",
            "Сербский динар",
            "Сингапурский доллар",
            "Таджикский сомони",
            "Таиландский бат",
            "Турецкая лира",
            "Узбекский сум",
            "Украинская гривна",
            "Фунт стерлингов Соединенного королевства",
            "Чешская крона",
            "Шведская крона",
            "Швейцарский франк",
            "Южноафриканский рэнд",
            "Японская иена"
        ];

        for ($i = 0; $i < count($search); $i++) {
            $query = [
                'search' => [$search[$i]],
                'page_size' => 300,
                'page' => 1,
            ];

            $newsList = $newsService->getNewsList($query);

            dump([$search[$i]]);
            dump($newsList);
            $this->assertNotEmpty($newsList);

            foreach ($newsList as $news) {
                $this->assertArrayHasKey('title', $news);
                $this->assertNotEquals("", $news['title']);

                $this->assertArrayHasKey('link', $news);
                $this->assertNotEquals("", $news['link']);

                $this->assertArrayHasKey('date', $news);
                $this->assertStringContainsString('назад', $news['date']);

                $this->assertArrayHasKey('description', $news);
                $this->assertNotEquals("", $news['description']);
            }
        }
    }
}
