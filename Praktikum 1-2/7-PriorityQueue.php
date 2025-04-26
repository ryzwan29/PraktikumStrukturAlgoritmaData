<?php 
class PriorityQueue { 
    private $items = []; 

    public function enqueue($item, $priority) { 
        $this->items[] = ["item" => $item, "priority" => $priority]; 
        usort($this->items, function($a, $b) { 
            return $b['priority'] - $a['priority']; 
        }); 
    } 

    public function dequeue() { 
        return array_shift($this->items) ['item']; 
    }

    public function isEmpty() { 
        return empty($this->items); 
    } 
} 

// Penggunaan 
$priorityQueue = new PriorityQueue(); 
$priorityQueue->enqueue("Task 1", 1); 
$priorityQueue->enqueue("Task 2", 2); 
echo $priorityQueue->dequeue(). "\n"; // Output: Task 2 
?> 
