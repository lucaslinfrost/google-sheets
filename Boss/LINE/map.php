<?php
  $maphop1 = "沒有";
  $graph = array(
  '拜倫陣地' => array('拜倫街','爆炸地中心'),
  '拜倫街' => array('米謝爾奈平原','拜倫陣地'),
  '米謝爾奈平原' => array('洛庫庫礦山之村','拜倫街'),
  '洛庫庫礦山之村' => array('米謝爾奈平原','洛庫庫坑道','洛恩法山脈'),
  '洛庫庫坑道' => array('洛庫庫礦山之村'),
  '洛恩法山脈' => array('洛庫庫街','洛庫庫礦山之村','洛恩法洞窟','洛庫庫風洞'),
);
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $code = explode(' ', $message['text']);
            $g = new Graph($graph);
            $g->leastHops($code[1], $code[2]);
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
$maphop = "沒有從【".$origin."】
到【".$destination."】的路。";
        }
        $maphop = substr($maphop, 0, -3);
        $maphop = $title."".$maphop;
        error_log("".$maphop."");
        $GLOBALS['maphop1'] = $GLOBALS['maphop1']."".$maphop;
    }
}
