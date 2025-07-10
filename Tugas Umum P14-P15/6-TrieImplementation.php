<?php
/**
 * Kelas TrieNode: merepresentasikan node pada struktur Trie.
 */
class TrieNode {
    public $children = [];
    public $isEndOfWord = false;

    public function __construct() {
        $this->children = [];
        $this->isEndOfWord = false;
    }
}

/**
 * Kelas Trie: mengelola penyisipan kata, pencarian, dan autocomplete.
 */
class Trie {
    private $root;

    public function __construct() {
        $this->root = new TrieNode();
    }

    // Menyisipkan kata ke dalam Trie (O(k))
    public function insert($word) {
        $node = $this->root;
        $letters = str_split($word);
        foreach ($letters as $char) {
            if (!isset($node->children[$char])) {
                $node->children[$char] = new TrieNode();
            }
            $node = $node->children[$char];
        }
        $node->isEndOfWord = true;
    }

    // Mencari kata dalam Trie (O(k))
    public function search($word) {
        $node = $this->root;
        $letters = str_split($word);
        foreach ($letters as $char) {
            if (!isset($node->children[$char])) {
                return false;
            }
            $node = $node->children[$char];
        }
        return $node->isEndOfWord;
    }

    // Mencari kata-kata yang diawali dengan prefix tertentu (autocomplete) (O(k + m))
    public function startsWith($prefix) {
        $node = $this->root;
        $letters = str_split($prefix);
        foreach ($letters as $char) {
            if (!isset($node->children[$char])) {
                return []; // Tidak ada kata dengan prefix tersebut
            }
            $node = $node->children[$char];
        }

        $words = [];
        $this->collectAllWords($node, $prefix, $words);
        return $words;
    }

    // Fungsi rekursif bantu untuk kumpulkan semua kata dari node tertentu
    private function collectAllWords($node, $prefix, &$words) {
        if ($node->isEndOfWord) {
            $words[] = $prefix;
        }

        foreach ($node->children as $char => $childNode) {
            $this->collectAllWords($childNode, $prefix . $char, $words);
        }
    }
}

// ===================
// Contoh Penggunaan:
// ===================

$trie = new Trie();

// Simulasi data dari dokumen, query, atau log sensor
$data = [
    "machine",
    "machinelearning",
    "iot",
    "internetofthings",
    "artificial",
    "artificialintelligence",
    "data",
    "datamining",
    "bigdata",
    "deeplearning",
    "datascience"
];

// Sisipkan data ke Trie
foreach ($data as $word) {
    $trie->insert(strtolower(str_replace(" ", "", $word))); // hilangkan spasi, lowercase
}

// Contoh pencarian kata
$searchQuery = "data";
if ($trie->search($searchQuery)) {
    echo "Kata '$searchQuery' ditemukan dalam Trie.\n";
} else {
    echo "Kata '$searchQuery' tidak ditemukan dalam Trie.\n";
}

// Contoh autocomplete berdasarkan prefix
$prefix = "data";
$wordsWithPrefix = $trie->startsWith($prefix);
echo "Kata-kata dengan prefix '$prefix':\n";
foreach ($wordsWithPrefix as $word) {
    echo "- $word\n";
}

echo "=============================\n";
echo "Made By: Rizwan Fairuz Mamduh\n";
?>
