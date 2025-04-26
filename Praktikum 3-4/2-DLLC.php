<?php
class LogNode { 
    public $itemName; 
    public $quantity; 
    public $timestamp; 
    public $next; 
    public $prev; 

    public function __construct($itemName, $quantity, $timestamp) { 
        $this->itemName = $itemName; 
        $this->quantity = $quantity; 
        $this->timestamp = $timestamp; 
        $this->next = null; 
        $this->prev = null; 
    } 
} 

class CircularLogList { 
    private $head = null; 
    private $tail = null; 

    // Menambahkan log pengeluaran barang 
    public function addLog($itemName, $quantity) { 
        $timestamp = date("Y-m-d H:i:s"); // Waktu sekarang 
        $newLog = new LogNode($itemName, $quantity, $timestamp); 

        if ($this->head === null) { 
            $this->head = $newLog; 
            $this->tail = $newLog; 
            $this->tail->next = $this->head; 
            $this->head->prev = $this->tail; 
        } else { 
            $this->tail->next = $newLog; 
            $newLog->prev = $this->tail; 
            $this->tail = $newLog; 
            $this->tail->next = $this->head; 
            $this->head->prev = $this->tail; 
        } 
    }

    // Menampilkan log pengeluaran 
    public function displayLogs() { 
        if ($this->head === null) { 
            return "No logs available.\n"; 
        } 

        $current = $this->head; 
        $logOutput = ""; 

        do { 
            $logOutput .= "Item: " . $current->itemName . ", Quantity: " . $current->quantity . ", Time: " . $current->timestamp . "\n"; 
            $current = $current->next; 
        } while ($current !== $this->head); 

        return $logOutput; 
    } 
} 

// Contoh penggunaan CircularLogList 
$logList = new CircularLogList(); 
$logList->addLog("Laptop", 2); 
$logList->addLog("Printer", 1); 
$logList->addLog("Scanner", 1);

// Menampilkan log pengeluaran barang 
echo "Log of Exited Items:\n"; 
echo $logList->displayLogs(); 

// Menampilkan Signature
echo "Made By 241232020 - Rizwan Fairuz Mamduh\n"; 
?>
