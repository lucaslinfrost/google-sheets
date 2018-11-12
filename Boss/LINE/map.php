<?php

require_once('./LINEBotTiny.php');
require_once('./utf8_chinese.class.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
// 取得事件(只接受文字訊息)
foreach ($client->parseEvents() as $event) {
switch ($event['type']) {       
    case 'message':
        // 讀入訊息
        $message = $event['message'];
        $c = new utf8_chinese;
        $message['text'] = $c->gb2312_big5($message['text']);
        $code = explode(' ', $message['text']);
}
};

class PriorityQueue extends SplPriorityQueue
{
    public function compare($p1, $p2) {
        if ($p1 == $p2) {
			return 0;
		}
		else {
            return ($p1 < $p2) ? 1 : -1;
		}
  }
}
class Dijkstra
{
    protected $graph;
    public function __construct($graph) {
        $this->graph = $graph;
    }
    public function shortestPath($source, $target) {
        // initialize Q, d and pi for all vertices
        $d = array();  // array of best estimates of shortest path to each vertex
        $pi = array(); // array of predecessors for each vertex
        $Q = new SplPriorityQueue(); // queue of all unoptimized vertices
        foreach ($this->graph as $v => $adj) {
            $d[$v] = INF; // set initial distance to "infinity"
            $pi[$v] = null; // no known predecessors yet
            foreach ($adj as $w => $cost) {
                // use the edge cost as the priority
                $Q->insert($w, $cost);
            }
        }
        // initial distance at source is 0
        $d[$source] = 0;
        while (!$Q->isEmpty()) {
            // extract min cost
            $u = $Q->extract();
            if (!empty($this->graph[$u])) {
                // "relax" each adjacent vertex
                foreach ($this->graph[$u] as $v => $cost) {
                    // alternate route length to adjacent neighbor
                    $alt = $d[$u] + $cost;
                    // if alternate route is shorter
                    if ($alt < $d[$v]) {
                        $d[$v] = $alt; // update minimum length to vertex
                        $pi[$v] = $u;  // add neighbor to predecessors for vertex
                    }
                }
            }
        }
        // we can now find the shortest path using reverse iteration
        $S = new SplStack(); // construct the shortest path with a stack S
        $u = $target;
        $dist = 0;
        // traverse from target to source
        while (isset($pi[$u]) && $pi[$u]) {
            $S->push($u);
            $dist += $this->graph[$u][$pi[$u]];  // add distance to next predecessor
            $u = $pi[$u];
        }
        // stack will be empty if there is no route back
        if ($S->isEmpty()) {
            $alltext = "No route from $source to $target\n";
        }
        else {
            // add the source node and print the path in reverse (LIFO) order
            $S->push($source);
            $totalmap = "$dist個地圖";
            $sep = '\n->';
            foreach ($S as $v) {
                $alltext = $alltext."".$sep."".$v;
            }
          
        }
    }
}
$graph = array(
  'A' => array('B' => 3, 'D' => 3, 'F' => 6),
  'B' => array('A' => 3, 'D' => 1, 'E' => 3),
  'C' => array('E' => 2, 'F' => 3),
  'D' => array('A' => 3, 'B' => 1, 'E' => 1, 'F' => 2),
  'E' => array('B' => 3, 'C' => 2, 'D' => 1, 'F' => 5),
  'F' => array('A' => 6, 'C' => 3, 'D' => 2, 'E' => 5),
);
$g = new Dijkstra($graph);
$g->shortestPath('$code[1]', '$code[2]');  // 3:D->E->C
