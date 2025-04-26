<?php 
class Deque { 
    private $items = []; 

    public function addFront($item) { 
        array_unshift($this->items, $item); 
    }

    public function addRear($item) { 
        $this->items[] = $item; 
    } 

    public function removeFront() { 
        return array_shift($this->items); 
    } 

    public function removeRear() { 
        return array_pop($this->items); 
    } 
    
    public function isEmpty() { 
        return empty($this->items); 
    } 
} 

// Penggunaan 
$deque = new Deque(); 
$deque->addRear(1); 
$deque->addFront(2); 
echo $deque->removeFront() . "\n"; // Output: 2 
echo $deque->removeRear(). "\n"; // Output: 1 
?> 
