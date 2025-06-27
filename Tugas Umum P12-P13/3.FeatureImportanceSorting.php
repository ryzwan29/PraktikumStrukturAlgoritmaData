<?php
?>
<!DOCTYPE html> 
<html> 
<head> 
    <title>ML Feature Importance Sorting</title> 
    <style> 
        body { font-family: Arial; margin: 20px; } 
        table { border-collapse: collapse; width: 100%; margin-top: 20px; } 
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; } 
        th { background-color: #f9f9f9; } 
        .container { max-width: 900px; margin: auto; } 
        .header { margin-bottom: 20px; } 
        .form-section { margin-bottom: 20px; } 
        .filter { margin-top: 10px; } 
    </style> 
</head> 
<body> 
    <div class="container"> 
        <div class="header"> 
            <h2>Machine Learning Feature Importance Sorting</h2> 
            <p>Sort model features by importance score and apply threshold filter.</p> 
        </div> 

        <div class="form-section"> 
            <form method="POST"> 
                <label for="order">Sort Order:</label> 
                <select id="order" name="order"> 
                    <option value="desc">Descending (High to Low)</option> 
                    <option value="asc">Ascending (Low to High)</option> 
                </select> 

                <label for="threshold">Importance Threshold (min):</label> 
                <input type="number" id="threshold" name="threshold" step="0.01" placeholder="0.00"> 

                <button type="submit" name="apply">Apply</button> 
            </form> 
        </div> 

        <?php
        // Simulated feature importance scores 
        $features = [ 
            ['feature' => 'Age', 'importance' => 0.12], 
            ['feature' => 'Income', 'importance' => 0.40], 
            ['feature' => 'Education', 'importance' => 0.22], 
            ['feature' => 'Location', 'importance' => 0.09], 
            ['feature' => 'Experience', 'importance' => 0.30], 
            ['feature' => 'Visits', 'importance' => 0.15], 
            ['feature' => 'Clicks', 'importance' => 0.05], 
            ['feature' => 'Duration', 'importance' => 0.18] 
        ]; 

        if (isset($_POST['apply'])) {
            $order = $_POST['order'];
            $threshold = is_numeric($_POST['threshold']) ? floatval($_POST['threshold']) : 0;

            // Filter by threshold
            $filtered = array_filter($features, function($f) use ($threshold) {
                return $f['importance'] >= $threshold;
            });

            // Sort based on order
            usort($filtered, function($a, $b) use ($order) {
                return ($order === 'asc') 
                    ? ($a['importance'] <=> $b['importance']) 
                    : ($b['importance'] <=> $a['importance']);
            });

            echo "<h3>Filtered & Sorted Features</h3>"; 
            echo "<table>"; 
            echo "<tr><th>No</th><th>Feature</th><th>Importance</th></tr>"; 
            $no = 1; 
            foreach ($filtered as $row) {
                echo "<tr>"; 
                echo "<td>{$no}</td>"; 
                echo "<td>{$row['feature']}</td>"; 
                echo "<td>" . number_format($row['importance'] * 100, 2) . "%</td>"; 
                echo "</tr>"; 
                $no++; 
            } 
            echo "</table>"; 
        }
        ?> 
    </div> 
</body> 
</html>
