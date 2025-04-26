<?php 
class Map { 
    private $elements = []; 

    public function put($key, $value) { 
        $this->elements[$key] = $value; 
    }

    public function get($key) { 
        return $this->elements[$key] ?? null; 
    }

    public function remove($key) { 
        unset($this->elements[$key]); 
    }

    public function display() { 
        return $this->elements; 
    } 
}
 
// Penggunaan 
$map = new Map(); 
$map->put("name", "John"); 
$map->put("age", 30); 
echo $map->get("name") . "\n"; // Output: John 
$map->remove("age"); 
print_r($map->display()); // Output: Array ( [name] => John ) 
?> 
