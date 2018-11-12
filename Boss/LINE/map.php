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
        $alltext = "111";
}
};

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
	count($path[$destination]) - 1;
            $alltext = $origin."to".$destination."in";
            $sep = '\n->';
            foreach ($path[$destination] as $vertex) {
                $alltext = $vertex."".$sep;
            }
        }
        else {
            $alltext =  "No route from".$origin."to".$destination;
        }
    }
}
$graph = array(
  'A' => array('B', 'F'),
  'B' => array('A', 'D', 'E'),
  'C' => array('F'),
  'D' => array('B', 'E'),
  'E' => array('B', 'D', 'F'),
  'F' => array('A', 'E', 'C'),
);
$g = new Graph($graph);
$g->leastHops('$code[1]', '$code[2]');
