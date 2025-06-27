<?php 
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Al Confidence Sorting</title> 
    <style> 
        body { font-family: Arial; margin: 20px; } 
        table { border-collapse: collapse; width: 100%; margin-top: 20px; } 
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; } 
        th { background-color: #f2f2f2; } 
        .container { max-width: 1000px; margin: auto; } 
        .header { margin-bottom: 20px; } 
        .form-section { margin-bottom: 20px; } 
    </style> 
</head> 
<body> 
    <div class="container"> 
        <div class="header"> 
            <h2>Q Advanced Al Object Detection Sorting</h2> 
            <p>Sort object predictions by confidence, time, or object name.</p> 
        </div> 

        <div class="form-section"> 
            <form method="POST"> 
                <label>Sort by:</label> 
                <select name="sort_by"> 
                    <option value="confidence">Confidence (High to Low)</option> 
                    <option value="object">Object Name (A-Z)</option> 
                    <option value="time">Time Detected (Newest First)</option> 
                </select> 
                <button type="submit" name="sort">Sort Data</button> 
            </form> 
        </div> 

        <?php 
        $predictions = [ 
            ["object" => "Person", "confidence" => 0.87, "time" => "2025-06-21 09:21:11"], 
            ["object" => "Dog", "confidence" => 0.54, "time" => "2025-06-21 09:21:15"], 
            ["object" => "Bicycle", "confidence" => 0.92, "time" => "2025-06-21 09:20:59"], 
            ["object" => "Car", "confidence" => 0.76, "time" => "2025-06-21 09:21:30"], 
            ["object" => "Motorbike", "confidence" => 0.67, "time" => "2025-06-21 09:21:45"], 
            ["object" => "Chair", "confidence" => 0.42, "time" => "2025-06-21 09:21:00"], 
            ["object" => "Laptop", "confidence" => 0.89, "time" => "2025-06-21 09:22:00"], 
            ["object" => "Tablet", "confidence" => 0.74, "time" => "2025-06-21 09:20:45"], 
            ["object" => "Phone", "confidence" => 0.79, "time" => "2025-06-21 09:22:10"], 
            ["object" => "Book", "confidence" => 0.61, "time" => "2025-06-21 09:21:55"] 
        ]; 

        if (isset($_POST['sort'])) { 
            $sortBy = $_POST['sort_by']; 
            switch ($sortBy) { 
                case 'confidence': 
                    usort($predictions, function ($a, $b) { 
                        return $b['confidence'] <=> $a['confidence']; 
                    }); 
                    break; 
                case 'object': 
                    usort($predictions, function ($a, $b) { 
                        return strcmp($a['object'], $b['object']); 
                    }); 
                    break; 
                case 'time': 
                    usort($predictions, function ($a, $b) { 
                        return strtotime($b['time']) <=> strtotime($a['time']); 
                    }); 
                    break; 
                default: 
                    break; 
            } 

            echo "<h3>Sorted Predictions</h3>"; 
            echo "<table>"; 
            echo "<tr><th>No</th><th>Object</th><th>Confidence</th><th>Detected Time</th></tr>"; 
            $no = 1; 
            foreach ($predictions as $row) { 
                echo "<tr>"; 
                echo "<td>{$no}</td>"; 
                echo "<td>{$row['object']}</td>"; 
                echo "<td>" . number_format($row['confidence'] * 100, 2) . "%</td>"; 
                echo "<td>{$row['time']}</td>"; 
                echo "</tr>"; 
                $no++; 
            } 
            echo "</table>"; 
        } 
        ?> 
    </div> 
</body> 
</html>
