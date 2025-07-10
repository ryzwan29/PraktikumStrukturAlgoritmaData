<?php 
/** 
 * Logistic Regression dengan Gradient Descent Regularized (L2) 
 * 
 * Dataset diasumsikan berupa array asosiatif:
 * - X: matriks fitur (m x n)
 * - y: label (0 atau 1)
 */

function sigmoid($z) {
    return 1 / (1 + exp(-$z));
}

function logisticRegressionGD($X, $y, $learning_rate = 0.01, $iterations = 1000, $lambda = 0.1) {
    $m = count($y);            // jumlah data
    $n = count($X[0]);         // jumlah fitur
    $theta = array_fill(0, $n, 0.0); // inisialisasi parameter model

    // Gradient descent
    for ($iter = 0; $iter < $iterations; $iter++) {
        $gradients = array_fill(0, $n, 0.0);

        // Hitung gradien untuk setiap data
        for ($i = 0; $i < $m; $i++) {
            $z = 0;
            for ($j = 0; $j < $n; $j++) {
                $z += $theta[$j] * $X[$i][$j];
            }
            $h = sigmoid($z);
            $error = $h - $y[$i];
            for ($j = 0; $j < $n; $j++) {
                $gradients[$j] += $error * $X[$i][$j];
            }
        }

        // Update parameter dengan regularisasi L2 (kecuali theta[0] bias)
        for ($j = 0; $j < $n; $j++) {
            $reg = ($j == 0) ? 0 : ($lambda / $m) * $theta[$j];
            $theta[$j] -= $learning_rate * (($gradients[$j] / $m) + $reg);
        }
    }

    return $theta;
}

// Contoh data (m = 4, n = 3)
$X = [
    [1, 2.5, 3.1],
    [1, 3.0, 3.8],
    [1, 2.8, 3.0],
    [1, 3.2, 3.9]
];

$y = [0, 1, 0, 1];

$theta = logisticRegressionGD($X, $y, 0.05, 2000, 0.05);

echo "Parameter model (theta):\n";
print_r($theta);
echo "=============================\n";
echo "Made By: Rizwan Fairuz Mamduh\n";

/**
 * Analisis:
 * - Setiap iterasi memproses m data dengan n fitur → O(m*n) per iterasi.
 * - Total iterasi T menghasilkan kompleksitas waktu O(T*m*n).
 * - Ruang: O(n) untuk theta dan gradien.
 */
?>
