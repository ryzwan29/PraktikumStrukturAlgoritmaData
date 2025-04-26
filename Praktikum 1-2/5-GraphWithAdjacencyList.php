<?php 
class Graph { 
    private $adjacencyList = []; 

    public function addVertex($vertex) { 
        $this->adjacencyList[$vertex] = []; 
    } 
    
    public function addEdge($vertex1, $vertex2){
        $this->adjacencyList[$vertex1][] = $vertex2; 
        $this->adjacencyList[$vertex2][] = $vertex1; // Untuk graf tak berarah 
    } 
 
    public function getAdjacencyList() { 
        return $this->adjacencyList; 
    } 
}

// Penggunaan 
$graph = new Graph(); 
$graph->addVertex("A"); 
$graph->addVertex("B"); 
$graph->addEdge("A", "B"); 
print_r($graph->getAdjacencyList()); // Output: Array ( [A] => Array ( [0] => B) [B] => Array ( [0] => A)) 
?> 
