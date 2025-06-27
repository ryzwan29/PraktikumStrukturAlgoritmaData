<?php 
?> 
<!DOCTYPE html> 
<html> 
<head> 
    <title>IoT Sensor Data Sorting</title> 
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
            <h2>IoT Sensor Data Sorting</h2> 
            <p>Sort environmental sensor data (temperature, humidity) from edge devices.</p> 
        </div> 

        <div class="form-section"> 
            <form method="POST"> 
                <label>Sort by:</label> 
                <select name="sort_by"> 
                    <option value="timestamp">Timestamp (Newest First)</option> 
                    <option value="temperature">Temperature (High to Low)</option> 
                    <option value="humidity">Humidity (Low to High)</option> 
                </select> 
                <button type="submit" name="sort">Sort Data</button> 
            </form> 
        </div> 

        <?php 
        $sensorData = [ 
            ["device" => "Sensor A", "temperature" => 30.1, "humidity" => 45, "timestamp" => "2025-06-21 09:01:30"], 
            ["device" => "Sensor B", "temperature" => 28.4, "humidity" => 50, "timestamp" => "2025-06-21 09:05:15"], 
            ["device" => "Sensor C", "temperature" => 32.0, "humidity" => 40, "timestamp" => "2025-06-21 09:03:00"], 
            ["device" => "Sensor D", "temperature" => 29.5, "humidity" => 48, "timestamp" => "2025-06-21 09:02:10"], 
            ["device" => "Sensor E", "temperature" => 27.8, "humidity" => 53, "timestamp" => "2025-06-21 09:04:00"] 
        ]; 

        if (isset($_POST['sort'])) { 
            $sortBy = $_POST['sort_by']; 
            switch ($sortBy) { 
                case 'timestamp': 
                    usort($sensorData, function ($a, $b) { 
                        return strtotime($b['timestamp']) <=> strtotime($a['timestamp']); 
                    }); 
                    break; 
                case 'temperature': 
                    usort($sensorData, function ($a, $b) { 
                        return $b['temperature'] <=> $a['temperature']; 
                    }); 
                    break; 
                case 'humidity': 
                    usort($sensorData, function ($a, $b) { 
                        return $a['humidity'] <=> $b['humidity']; 
                    }); 
                    break; 
                default: 
                    break; 
            } 

            echo "<h3>Sorted Sensor Data</h3>"; 
            echo "<table>"; 
            echo "<tr><th>No</th><th>Device</th><th>Temperature (°C)</th><th>Humidity (%)</th><th>Timestamp</th></tr>"; 
            $no = 1; 
            foreach ($sensorData as $row) { 
                echo "<tr>"; 
                echo "<td>{$no}</td>"; 
                echo "<td>{$row['device']}</td>"; 
                echo "<td>{$row['temperature']}</td>"; 
                echo "<td>{$row['humidity']}</td>"; 
                echo "<td>{$row['timestamp']}</td>"; 
                echo "</tr>"; 
                $no++; 
            } 
            echo "</table>"; 
        } 
        ?> 
    </div> 
</body> 
</html>
