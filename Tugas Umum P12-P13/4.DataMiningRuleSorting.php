<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mining Rule Sorting</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f4f4f4; }
        .container { max-width: 1000px; margin: auto; }
        .form-section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Association Rule Sorting (Data Mining)</h2>
        <p>Evaluate and sort rules from association mining using confidence and lift.</p>

        <div class="form-section">
            <form method="POST">
                <label for="sort_by">Sort by:</label>
                <select name="sort_by" id="sort_by">
                    <option value="confidence">Confidence (High to Low)</option>
                    <option value="lift">Lift (High to Low)</option>
                </select>

                <label for="min_conf">Min Confidence:</label>
                <input type="number" step="0.01" name="min_conf" placeholder="0.60">

                <label for="min_lift">Min Lift:</label>
                <input type="number" step="0.01" name="min_lift" placeholder="1.00">

                <button type="submit" name="apply">Apply Filter</button>
            </form>
        </div>

        <?php
        $rules = [
            ["rule" => "Milk => Bread", "confidence" => 0.78, "lift" => 1.21],
            ["rule" => "Beer => Diaper", "confidence" => 0.63, "lift" => 1.05],
            ["rule" => "Eggs => Bacon", "confidence" => 0.69, "lift" => 1.15],
            ["rule" => "Chips => Soda", "confidence" => 0.81, "lift" => 1.34],
            ["rule" => "Butter => Milk", "confidence" => 0.55, "lift" => 0.98],
            ["rule" => "Cereal => Milk", "confidence" => 0.88, "lift" => 1.45],
            ["rule" => "Yogurt => Berries", "confidence" => 0.60, "lift" => 1.00],
        ];

        if (isset($_POST['apply'])) {
            $sortBy = $_POST['sort_by'];
            $minConf = isset($_POST['min_conf']) && is_numeric($_POST['min_conf']) ? floatval($_POST['min_conf']) : 0.0;
            $minLift = isset($_POST['min_lift']) && is_numeric($_POST['min_lift']) ? floatval($_POST['min_lift']) : 0.0;

            // Filter rules based on confidence and lift
            $filtered = array_filter($rules, function ($r) use ($minConf, $minLift) {
                return $r['confidence'] >= $minConf && $r['lift'] >= $minLift;
            });

            // Sort rules
            usort($filtered, function ($a, $b) use ($sortBy) {
                return $b[$sortBy] <=> $a[$sortBy];
            });

            echo "<h3>Sorted Association Rules</h3>";
            echo "<table>";
            echo "<tr><th>No</th><th>Rule</th><th>Confidence</th><th>Lift</th></tr>";
            $no = 1;
            foreach ($filtered as $rule) {
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$rule['rule']}</td>";
                echo "<td>" . number_format($rule['confidence'] * 100, 2) . "%</td>";
                echo "<td>" . number_format($rule['lift'], 2) . "</td>";
                echo "</tr>";
                $no++;
            }
            echo "</table>";
        }
        ?>
    </div>
</body>
</html>
