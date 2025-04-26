<?php 
class ItemNode { 
    public $itemName; 
    public $quantity; 
    public $next; 

    public function __construct($itemName, $quantity) { 
        $this->itemName = $itemName; 
        $this->quantity = $quantity; 
        $this->next = null; 
    } 
} 

class CircularItemList { 
    private $head = null; 
    private $tail = null; 

    // Menambahkan barang baru 
    public function addItem($itemName, $quantity) { 
        $newItem = new ItemNode($itemName, $quantity); 
        if ($this->head === null) { 
            $this->head = $newItem; 
            $this->tail = $newItem; 
            $this->tail->next = $this->head; 
        } else { 
            $this->tail->next = $newItem; 
            $this->tail = $newItem; 
            $this->tail->next = $this->head; 
        } 
    }

    // Menampilkan semua barang 
    public function displayItems() { 
        if ($this->head === null) { 
            return "No items available.\n"; 
        } 
        $current = $this->head; 
        $itemsOutput = ""; 
        do { 
            $itemsOutput .= "Item: " . $current->itemName . ", Quantity: " . $current->quantity . "\n"; 
            $current = $current->next; 
        } while ($current !== $this->head); 
        return $itemsOutput; 
    } 
} 

// Contoh penggunaan CircularItemList 
$itemList = new CircularItemList(); 
$itemList->addItem("Laptop", 10); 
$itemList->addItem("Printer", 5); 
$itemList->addItem("Scanner", 3);

// Menampilkan semua barang 
echo "Available Items in Warehouse:\n"; 
echo $itemList->displayItems(); 

// Menampilkan Signature
echo "Made By 241232020 - Rizwan Fairuz Mamduh\n"; 
?>
