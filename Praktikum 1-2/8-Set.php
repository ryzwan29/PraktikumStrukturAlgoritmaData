<?php 
class Set { 
    private $elements = []; 

    public function add($element) { 
        if (!in_array($element, $this->elements)) { 
            $this->elements[] = $element; 
        } 
    } 

    public function contains($element) { 
        return in_array($element, $this->elements); 
    }
    
    public function remove($element) { 
        $index = array_search($element, $this->elements); 
        if ($index !== false) { 
            unset($this->elements[$index]); 
            $this->elements = array_values($this->elements); // Reindex array 
        } 
    }

    public function display() { 
        return $this->elements; 
    } 
}

// Penggunaan 
$set = new Set(); 
$set->add("Apple"); 
$set->add("Banana"); 
$set->add("Apple"); // Tidak akan ditambahkan 
print_r($set->display()); // Output: Array ( [0] => Apple [1] => Banana) 
$set->remove("Apple"); 
print_r($set->display()); // Output: Array ( [0] => Banana) 
?> 
