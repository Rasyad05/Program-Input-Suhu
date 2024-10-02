<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status AC</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            color: #555;
        }

        select {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            width: 100%;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .result {
            margin-top: 20px;
            text-align: center;
        }

        .result p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Status AC Berdasarkan Suhu dan Kelembapan</h1>
        
        <form method="POST">
            <label for="suhu">Pilih Suhu:</label>
            <select id="suhu" name="suhu" required>
                <option value="" disabled selected>Pilih suhu</option>
                <option value="30">30°C atau lebih</option>
                <option value="25">25°C - 29°C</option>
                <option value="20">20°C - 24°C</option>
                <option value="19">Dibawah 20°C</option>
            </select>
            
            <label for="kelembapan">Pilih Kelembapan:</label>
            <select id="kelembapan" name="kelembapan" required>
                <option value="" disabled selected>Pilih kelembapan</option>
                <option value="100">100%</option>
                <option value="75">75%</option>
                <option value="50">50%</option>
                <option value="25">25%</option>
            </select>
            
            <button type="submit">Cek Status AC</button>
        </form>

        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $suhu = (float)$_POST["suhu"];
                $kelembapan = (float)$_POST["kelembapan"];

                function checkACStatus($suhu, $kelembapan) {
                    if ($suhu >= 30 && $kelembapan == 100) {
                        return "AC MENYALA DENGAN KEKUATAN TINGGI";
                    } elseif ($suhu >= 25 && $suhu < 30 && $kelembapan == 75) {
                        return "AC MENYALA DENGAN KEKUATAN SEDANG";
                    } elseif ($suhu >= 20 && $suhu < 25 && $kelembapan == 50) {
                        return "AC MENYALA DENGAN KEKUATAN RENDAH";
                    } elseif ($suhu < 20 && $kelembapan == 25) {
                        return "AC TIDAK MENYALA";
                    } else {
                        return "Data tidak valid";
                    }
                }

                $statusAC = checkACStatus($suhu, $kelembapan);
                echo "<p>Hasil: <strong>$statusAC</strong></p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
