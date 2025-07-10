<?php
// Data transaksi: setiap transaksi berisi array item
$transactions = [
    ['susu', 'roti', 'keju'],
    ['roti', 'keju'],
    ['susu', 'roti'],
    ['roti', 'keju'],
    ['susu', 'keju']
];

$minSupport = 0.6; // minimum support
$totalTransactions = count($transactions);

// Fungsi menghitung support suatu itemset
function countSupport($transactions, $itemset) {
    $count = 0;
    foreach ($transactions as $trans) {
        if (count(array_intersect($trans, $itemset)) == count($itemset)) {
            $count++;
        }
    }
    return $count / count($transactions);
}

// Mendapatkan frequent 1-itemset
function apriori1Itemset($transactions, $minSupport) {
    $itemCounts = [];

    foreach ($transactions as $trans) {
        foreach ($trans as $item) {
            if (!isset($itemCounts[$item])) {
                $itemCounts[$item] = 0;
            }
            $itemCounts[$item]++;
        }
    }

    $frequent1 = [];
    foreach ($itemCounts as $item => $count) {
        $support = $count / count($transactions);
        if ($support >= $minSupport) {
            $frequent1[implode(',', [$item])] = $support;
        }
    }

    return $frequent1;
}

// Membuat kandidat 2-itemset dari frequent 1-itemset
function generateCandidates($frequent1) {
    $items = array_keys($frequent1);
    $items = array_map(function($item) {
        return trim($item);
    }, $items);

    $candidates = [];
    $n = count($items);

    for ($i = 0; $i < $n; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            $candidate = [$items[$i], $items[$j]];
            sort($candidate);
            $candidates[] = $candidate;
        }
    }

    return $candidates;
}

// Evaluasi frequent 2-itemset
function apriori2Itemset($transactions, $candidates, $minSupport) {
    $frequent2 = [];

    foreach ($candidates as $candidate) {
        $support = countSupport($transactions, $candidate);
        if ($support >= $minSupport) {
            $frequent2[implode(', ', $candidate)] = $support;
        }
    }

    return $frequent2;
}

// Proses Apriori
$frequent1 = apriori1Itemset($transactions, $minSupport);
$candidates2 = generateCandidates($frequent1);
$frequent2 = apriori2Itemset($transactions, $candidates2, $minSupport);

// Output hasil
echo "Frequent 1-itemsets:\n";
print_r($frequent1);

echo "\nFrequent 2-itemsets:\n";
print_r($frequent2);

echo "=============================\n";
echo "Made By: Rizwan Fairuz Mamduh\n";
?>
