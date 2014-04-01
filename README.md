TripleI.Weather  [![Build Status](https://travis-ci.org/Skobayashi/Weather.svg?branch=master)](https://travis-ci.org/Skobayashi/Weather) [![Coverage Status](https://coveralls.io/repos/Skobayashi/Weather/badge.png?branch=master)](https://coveralls.io/r/Skobayashi/Weather?branch=master) 
=======
引数に地名を与えて明日の天気を返すコマンドラインツールです。  
livedoor の天気情報を利用しています。  
下記アドレスに記載のない地名では天気を取得することが出来ません。  
http://weather.livedoor.com/weather_hacks/webservice


動作環境
------------
 * PHP 5.3+

使い方
---------------

### bin/weather を実行します
```
 $ bin/weather 豊橋
 $ -- 豊橋の明日の天気 --
 $ 晴のち曇
 $ 最高気温 16 度
 $ 最高気温 8 度
```