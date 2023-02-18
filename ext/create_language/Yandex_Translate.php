<?php

/*
 * пример: https://translate.yandex.net/api/v1.5/tr.json/getLangs?key=trnsl.1.1.20171017T112242Z.e7fcd56d1f151185.c995561505c76bcdfbaba997b1f9f5fb513a5750
 * ответ: {"dirs":["az-ru","be-bg","be-cs","be-de","be-en","be-es","be-fr","be-it","be-pl","be-ro","be-ru","be-sr","be-tr","bg-be","bg-ru","bg-uk","ca-en","ca-ru","cs-be","cs-en","cs-ru","cs-uk","da-en","da-ru","de-be","de-en","de-es","de-fr","de-it","de-ru","de-tr","de-uk","el-en","el-ru","en-be","en-ca","en-cs","en-da","en-de","en-el","en-es","en-et","en-fi","en-fr","en-hu","en-it","en-lt","en-lv","en-mk","en-nl","en-no","en-pt","en-ru","en-sk","en-sl","en-sq","en-sv","en-tr","en-uk","es-be","es-de","es-en","es-ru","es-uk","et-en","et-ru","fi-en","fi-ru","fr-be","fr-de","fr-en","fr-ru","fr-uk","hr-ru","hu-en","hu-ru","hy-ru","it-be","it-de","it-en","it-ru","it-uk","lt-en","lt-ru","lv-en","lv-ru","mk-en","mk-ru","nl-en","nl-ru","no-en","no-ru","pl-be","pl-ru","pl-uk","pt-en","pt-ru","ro-be","ro-ru","ro-uk","ru-az","ru-be","ru-bg","ru-ca","ru-cs","ru-da","ru-de","ru-el","ru-en","ru-es","ru-et","ru-fi","ru-fr","ru-hr","ru-hu","ru-hy","ru-it","ru-lt","ru-lv","ru-mk","ru-nl","ru-no","ru-pl","ru-pt","ru-ro","ru-sk","ru-sl","ru-sq","ru-sr","ru-sv","ru-tr","ru-uk","sk-en","sk-ru","sl-en","sl-ru","sq-en","sq-ru","sr-be","sr-ru","sr-uk","sv-en","sv-ru","tr-be","tr-de","tr-en","tr-ru","tr-uk","uk-bg","uk-cs","uk-de","uk-en","uk-es","uk-fr","uk-it","uk-pl","uk-ro","uk-ru","uk-sr","uk-tr"]}
 * Класс для использования API переводчика от Яндекс
 * Идеален для славянских языков, в частности русский <-> украинский
 */

class Yandex_Translate
{
    protected $rootURL = 'https://translate.yandex.net/api/v1.5/tr.json';
    protected $translatePath = '/translate';
    protected $langCodesPairsListPath = '/getLangs';
    protected $apiKey = 'trnsl.1.1.20190402T102510Z.a123ecb807bc7a83.8130185fe7b69f23bd5c4a94260e92f57bc6422e';
//    protected $apiKey = 'trnsl.1.1.20161223T143629Z.b9f1ea9c1c36c2ec.b78dbd9117c3bbce1a54fb678933e68a5c59e79e';

    /**
     * @var string - символ или тег конца абзаца
     * Варианты: вывод в браузер - <br />, в файл - \n, может зависеть от ОС
     */
    public $eolSymbol = '';

    /**
     * @var string - разделитель языков в запросе. Пока однозначно так определено Яндексом
     */
    public $langDelimiter = '-';

    /**
     * @var int - максимальное число символов для отправки переводчику
     */
    public $symbolLimit = 2000;

    /**
     * @var string- символы, по которым текст делится на предложения
     */
    public $sentensesDelimiter = '.';

    /**
     * @static
     * @param  $text - исходный текст для разбиения на предложения
     * @return array - массив предложений, еще не окончательный
     */
    protected function toSentenses($text)
    {
        $sentArray = explode($this->sentensesDelimiter, $text);
        return $sentArray;
    }

    /**
     * Разделение текста на массив больших кусков
     * @param string $text - большой текстовый фрагмент, требующий разделения на куски
     * @return  array - массив элементов, каждый из которых не превышает предельного числа символов
     */

    public function toBigPieces($text)
    {
        $sentArray = $this->toSentenses($text);
        $i = 0;
        $bigPiecesArray[0] = '';
        for ($k = 0; $k < count($sentArray); $k++) {
            $bigPiecesArray[$i] .= $sentArray[$k] . $this->sentensesDelimiter;
            if (strlen($bigPiecesArray[$i]) > $this->symbolLimit) {
                $i++;
                $bigPiecesArray[$i] = '';
            }
        }

        return $bigPiecesArray;
    }

    /**
     * Склеивание текста
     * @param array $bigPiecesArray - массив переведенных кусков текста, в произвольном порядке,
     * но ключи должна соответствовать исходному тексту
     * @return string - "склеенный" текст
     */
    public function fromBigPieces(array $bigPiecesArray)
    {

        ksort($bigPiecesArray);

        return implode($bigPiecesArray);
    }


    protected $cURLHeaders = array(
        'User-Agent' => "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0; .NET CLR 2.0.50727)",
        'Accept' => "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        'Accept-Language' => "ru,en-us;q=0.7,en;q=0.3",
        'Accept-Encoding' => "gzip,deflate",
        'Accept-Charset' => "windows-1251,utf-8;q=0.7,*;q=0.7",
        'Keep-Alive' => '300',
        'Connection' => 'keep-alive',
    );

    protected function yandexConnect($path, $transferData = array())
    {
        $res = curl_init();
        if (sizeof($transferData) > 0) {
            $url = $this->rootURL . $path . '?key=' . $this->apiKey . '&' . http_build_query($transferData);
        } else {
            $url = $this->rootURL . $path . '?key=' . $this->apiKey;
        }
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $this->cURLHeaders,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 30,

        );
        curl_setopt_array($res, $options);
        $response = curl_exec($res);
        curl_close($res);

        //var_dump($response);
        //die;

        return $response;
    }

    /**
     * @return mixed Получаем пары перевода from-to в виде 'ru-uk', 'en-fr'
     */
    public function yandexGetLangsPairs()
    {

        $jsonLangsPairs = $this->yandexConnect($this->langCodesPairsListPath);

        $rawOut = json_decode($jsonLangsPairs, true);

        return $rawOut['dirs'];
    }

    /**
     * @return получаем все языки FROM
     */
    public function yandexGet_FROM_Langs()
    {

        $langPairs = $this->yandexGetLangsPairs();

        foreach ($langPairs as $langPair) {
            $smallArray = explode($this->langDelimiter, $langPair);
            $outerArray[$smallArray[0]] = $smallArray[0];
        }
        return $outerArray;
    }

    /**
     * @return получаем все языки TO
     */
    public function yandexGet_TO_Langs()
    {

        $langPairs = $this->yandexGetLangsPairs();

        foreach ($langPairs as $langPair) {
            $smallArray = explode($this->langDelimiter, $langPair);
            $outerArray[$smallArray[1]] = $smallArray[1];
        }
        return $outerArray;
    }

    /**
     * Собственно перевод
     * @param  $fromLang - с какого, код языка, 'ru' напр.
     * @param  $toLang - на какой, код языка. Следите: не все языки FROM доступны в TO
     * @param  $text - переводимый текст
     * @return mixed - перевод. Следите за разделителями eolSymbol
     */
    public function yandexTranslate($fromLang, $toLang, $text)
    {

        //один из языков должен быть ru - проверяем, хотя переводчик и так вернет текст - сообщение об ошибке

//        if ($fromLang != 'ru' AND $toLang != 'ru'){
//            return 'Sorry, translation directly from '.$fromLang.' to '.$toLang.' is impossible';
//        }

        $transferData = array(
            'lang' => $fromLang . '-' . $toLang,
            'text' => htmlspecialchars($text),
            'format' => 'html',
        );

        $rawTranslate = $this->yandexConnect($this->translatePath, $transferData);

        $rawTranslate = trim($rawTranslate, '"');

        $translate = str_replace('\n', $this->eolSymbol, $rawTranslate);

        return $translate;
    }

    public function removeHtmlComments($html)
    {
        return preg_replace('/<!--(.*?)-->/s', '', $html);
    }
}
