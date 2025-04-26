<?php 
class Queue { 
    private $items = []; 
    
    public function enqueue($item) { 
        $this->items[] = $item; 
    } 

    public function dequeue() { 
        return array_shift($this->items); 
    }
    
    public function peek() { 
        return $this->items[0] ?? null; 
    } 

    public function isEmpty() { 
        return empty($this->items); 
    } 
} 

// Penggunaan 
$queue = new Queue(); 
$queue->enqueue("First"); 
$queue->enqueue("Second"); 
echo $queue->peek() . "\n"; // Output: First 

$queue->dequeue(); 
echo $queue->peek() . "\n"; // Output: Second 
?> 
