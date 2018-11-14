<?php
  $graph = array(
    '拜倫陣地' => array('拜倫街','爆炸地中心'),
    '拜倫街' => array('米謝爾奈平原','拜倫陣地'),
    '米謝爾奈平原' => array('洛庫庫礦山之村','拜倫街'),
    '洛庫庫礦山之村' => array('米謝爾奈平原','洛庫庫坑道','洛恩法山脈'),
    '洛庫庫坑道' => array('洛庫庫礦山之村'),
    '洛恩法山脈' => array('洛庫庫街','洛庫庫礦山之村','洛恩法洞窟','洛庫庫風洞'),
    '洛庫庫風洞' => array('洛恩法山脈','迪魯村','洛庫庫風洞・下層'),
    '洛庫庫風洞・下層' => array('洛庫庫風洞'),
    '洛恩法洞窟' => array('洛恩法山脈','洛恩法山脈・山頂'),
    '洛恩法山脈・山頂' => array('洛恩法洞窟'),
    '迪魯村' => array('洛庫庫風洞'),
    '洛庫庫街' => array('洛恩法山脈','魔女狩獵之森','洛庫庫平原'),
    '魔女狩獵之森' => array('麗塔的家','洛庫庫街'),
    '麗塔的家' => array('魔女狩獵之森'),
    '洛庫庫平原' => array('洛庫庫街','被遺忘的洞窟','薩烏格沼澤'),
    '被遺忘的洞窟' => array('洛庫庫平原','被遺忘的洞窟B1'),
    '被遺忘的洞窟B1' => array('被遺忘的洞窟','被遺忘的洞窟B2'),
    '被遺忘的洞窟B2' => array('被遺忘的洞窟B1'),
    '薩烏格沼澤' => array('洛庫庫平原','內吉木沼澤','特裏拖之森','龍王的浮島'),
    '內吉木沼澤' => array('薩烏格沼澤','扎魯巴平原'),
    '特裏拖之森' => array('薩烏格沼澤','月之民的村子','灼熱隧道'),
    '月之民的村子' => array('特裏拖之森','暗之領域'),
    '灼熱隧道' => array('特裏拖之森','灼熱隧道・B1'),
    '灼熱隧道・B1' => array('灼熱隧道','灼熱隧道・B2'),
    '灼熱隧道・B2' => array('灼熱隧道・B1','灼熱隧道・火山口'),
    '灼熱隧道・火山口' => array('灼熱隧道・B2'),
    '龍王的浮島' => array('薩烏格沼澤','龍王的浮島・F2'),
    '龍王的浮島・F2' => array('龍王的浮島','龍王的浮島・F3'),
    '龍王的浮島・F3' => array('龍王的浮島・F2','龍王的浮島・謁見之間'),
    '龍王的浮島・謁見之間' => array('龍王的浮島・F3'),
    '暗之領域' => array('月之民的村子','暗之荒野'),
    '暗之荒野' => array('暗之領域','暗之館・1層'),
    '暗之館・1層' => array('暗之荒野','暗之館・2層'),
    '暗之館・2層' => array('暗之館・1層','暗之館・3層'),
    '暗之館・3層' => array('暗之館・2層','暗之館・大廳'),
    '暗之館・大廳' => array('暗之館・3層','暗之城'),
    '暗之城' => array('月之民的村子','暗之城・2層'),
    '暗之城・2層' => array('暗之城','暗之城・3層'),
    '暗之城・3層' => array('暗之城・2層','暗之城・玉座之間'),
    '暗之城・玉座之間' => array('暗之城・3層'),
    '扎魯巴平原' => array('內吉木沼澤','首都索菲亞'),
    '首都索菲亞' => array('扎魯巴平原','索菲亞郊外','落星山街道','索菲斯大教堂','酒吧・女神之泉','首都索菲亞・執政官邸'),
    '索菲斯大教堂' => array('首都索菲亞'),
    '酒吧・女神之泉' => array('首都索菲亞'),
    '首都索菲亞・執政官邸' => array('首都索菲亞','首都索菲亞・公會'),
    '首都索菲亞・公會' => array('首都索菲亞・執政官邸'),
    '索菲亞郊外' => array('首都索菲亞','克魯達峰'),
    '克魯達峰' => array('索菲亞郊外','尼迪亞海岸'),
    '尼迪亞海岸' => array('克魯達峰','風之洞穴・1樓','伊洛島'),
    '風之洞穴・1樓' => array('尼迪亞海岸','風之洞穴・2樓'),
    '風之洞穴・2樓' => array('風之洞穴・1樓','風之洞穴・3樓'),
    '風之洞穴・3樓' => array('風之洞穴・2樓','風之洞穴・4樓'),
    '風之洞穴・4樓' => array('風之洞穴・3樓','風之洞穴・深部'),
    '風之洞穴・深部' => array('風之洞穴・4樓'),
    '伊洛島' => array('尼迪亞海岸','古力埃要塞・F1'),
    '古力埃要塞・F1' => array('伊洛島','古力埃要塞・F2'),
    '古力埃要塞・F2' => array('古力埃要塞・F1','古力埃要塞・F3'),
    '古力埃要塞・F3' => array('古力埃要塞・F2','古力埃要塞・F4'),
    '古力埃要塞・F4' => array('古力埃要塞・F3','古力埃要塞・F5'),
    '古力埃要塞・F5' => array('古力埃要塞・F4','古力埃要塞・F6'),
    '古力埃要塞・F6' => array('古力埃要塞・F5','古力埃要塞・最頂層'),
    '古力埃要塞・最頂層' => array('古力埃要塞・F6'),
    '落星山街道' => array('首都索菲亞','羅魯巴平原'),
    '羅魯巴平原' => array('落星山街道','巨木洞窟・F1','卡盧艾湖'),
    '巨木洞窟・F1' => array('羅魯巴平原','巨木洞窟・F2'),
    '巨木洞窟・F2' => array('巨木洞窟・F1','巨木洞窟・F3'),
    '巨木洞窟・F3' => array('巨木洞窟・F2','巨木洞窟・F4'),
    '巨木洞窟・F4' => array('巨木洞窟・F3','巨木洞窟・樹頂'),
    '巨木洞窟・樹頂' => array('巨木洞窟・F4'),
    '卡盧艾湖' => array('羅魯巴平原','扎魯姆沙漠','特希安高原'),
    '扎魯姆沙漠' => array('卡盧艾湖','冰之塔'),
    '冰之塔' => array('扎魯姆沙漠','冰之塔・2F'),
    '冰之塔・2F' => array('冰之塔','冰之塔・3F'),
    '冰之塔・3F' => array('冰之塔・2F','冰之塔・4F'),
    '冰之塔・4F' => array('冰之塔・3F','冰之塔・5F'),
    '冰之塔・5F' => array('冰之塔・4F','冰之塔・頂樓'),
    '冰之塔・頂樓' => array('冰之塔・5F'),
    '特希安高原' => array('卡盧艾湖','維波街'),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
);
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $code = explode('#', $message['text']);
            
        break;
        }
}

class Graph
{
    protected $graph;
    protected $visited = array();
    public function __construct($graph) {
        $this->graph = $graph;
    }
public function leastHops($origin, $destination) {
        // mark all nodes as unvisited
        foreach ($this->graph as $key => $vertex) {
            $this->visited[$key] = false;
        }
        // create an empty queue
        $q = new SplQueue();
      
        // enqueue the origin vertex and mark as visited
        $q->enqueue($origin);
        $this->visited[$origin] = true;
      
        // an array stack to track the path back from each node
        $path = array();
        $path[$origin] = new SplDoublyLinkedList();
        $path[$origin]->setIteratorMode(
            SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP
        );
      
        $path[$origin]->push($origin);
      
        $found = false;
        // while queue is not empty and destination not found
        while (!$q->isEmpty() && $q->bottom() != $destination) {
            $t = $q->dequeue();
      
            if (!empty($this->graph[$t])) {
                // for each adjacent neighbor
                foreach ($this->graph[$t] as $vertex) {
                    if (!$this->visited[$vertex]) {
                        // if not yet visited, enqueue vertex and mark as visited
                        $q->enqueue($vertex);
                        $this->visited[$vertex] = true;
                        // add vertex to current node path
                        $path[$vertex] = clone $path[$t];
                        $path[$vertex]->push($vertex);
                    }
                }
            }
        }
        
        if (isset($path[$destination])) {
            $mapno = count($path[$destination]) - 1;
                " 個地圖\n";
$title = "從【".$origin."】
到【".$destination."】
會通過".$mapno."個傳點。

--------  開始導航  --------
";
            foreach ($path[$destination] as $vertex) {
$sep = "
->";
                $maphop = $maphop."".$vertex."".$sep;
            }
        }
        else {
$maphop = "沒有找到從【".$origin."】
到【".$destination."】的路喔。。";
        }
        $maphop = substr($maphop, 0, -3);
        $maphop = $title."".$maphop;
        error_log("".$maphop."");
  
  
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
    case 'message':
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $maphop
            )
        )
    ));
}
}
  
  
    }
}
$g = new Graph($graph);
$g->leastHops($code[1], $code[2]);
