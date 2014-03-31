<?php
/**
 * Livedoor Whather API
 * http://weather.livedoor.com/weather_hacks/webservice
 **/


namespace TripleI\Weather;

class App
{

    /**
     * 都市名
     *
     * @var String
     **/
    public $city;


    /**
     * 天気データの取得
     *
     * @param Array $params  引数の配列
     * @return String
     **/
    public function execute (Array $params)
    {
        try {
            $this->_validateParamesters($params);
            
            $this->city = $city = trim($params[1]);
            $city_id = $this->_getCityId($city);

            $result = $this->_callAPI($city_id);
        
        } catch (\Exception $e) {
            throw $e;
        }

        return $result;
    }



    /**
     * 引数をバリデートする
     *
     * @param Array $params  引数
     * @return void
     **/
    private function _validateParamesters (Array $params)
    {
        if (! isset($params[1])) {
            throw new \Exception('地名を指定してください');
        }
    }



    /**
     * LivedoorAPI用のCityIDを取得する
     * 存在しない都市名の場合はExceptionを投げる
     *
     * @param String $city
     * @return int
     **/
    private function _getCityId ($city)
    {
        $dom = new \DOMDocument();
        $dom->loadXML(file_get_contents('http://weather.livedoor.com/forecast/rss/primary_area.xml'));
        $cities  = $dom->getElementsByTagName('city');
        $city_id = null;

        foreach ($cities as $city_el) {
            if ($city_el->getAttribute('title') == $city) {
                $city_id = $city_el->getAttribute('id');
                break;
            }
        }

        if (is_null($city_id)) {
            throw new \Exception('APIに適さない地名です');
        }

        return $city_id;
    }



    /**
     * APIを呼び出す
     *
     * @param int $city_id  都市ID
     * @return String
     **/
    private function _callAPI ($city_id)
    {
        $url = sprintf('http://weather.livedoor.com/forecast/webservice/json/v1?city=%s', $city_id);
        $result = json_decode(file_get_contents($url));

        // 明日の天気
        $weather = $result->forecasts[1];

        $message = '-- '.$this->city.'の明日の天気 --'.PHP_EOL.
            $weather->telop.PHP_EOL.
            '最高気温 '.$weather->temperature->max->celsius.' 度'.PHP_EOL.
            '最高気温 '.$weather->temperature->min->celsius.' 度'.PHP_EOL;

        return $message;
    }
}
