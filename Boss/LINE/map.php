<?php
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
            echo "$origin 到 $destination 會經過 ", count($path[$destination]) - 2,
                " 個地圖\n";
            $sep = '';
            foreach ($path[$destination] as $vertex) {
                echo $sep, $vertex;
                $sep = '->';
            }
            echo "\n";
        else {
            echo "No route from $origin to $destination\n";
        }
    }
}

$graph = array(
  '拜倫陣地' => array('拜倫街','爆炸地中心'),
  '拜倫街' => array('米謝爾奈平原','拜倫陣地'),
  '米謝爾奈平原' => array('洛庫庫礦山之村','拜倫街'),
  '洛庫庫礦山之村' => array('米謝爾奈平原','洛庫庫坑道','洛恩法山脈'),
  '洛庫庫坑道' => array('洛庫庫礦山之村'),
  '洛恩法山脈' => array('洛庫庫街','洛庫庫礦山之村','洛恩法洞窟','洛庫庫風洞'),
);

$g = new Graph($graph);
$g->leastHops('拜倫陣地', '洛恩法山脈');

