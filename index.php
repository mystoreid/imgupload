<?php
// Fungsi untuk membaca data dari file JSON
function readStockData() {
    if (!file_exists('data/stock_data.json')) {
        return [];
    }
    $json = file_get_contents('data/stock_data.json');
    return json_decode($json, true);
}

// Inisialisasi data jika belum ada
if (empty(readStockData())) {
    $initialData = [
        [
            'id' => 1,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'completed',
            'delivery_date' => null
        ],
        [
            'id' => 2,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'pending',
            'delivery_date' => '2025-09-01 19:40:00'
        ],
        [
            'id' => 3,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'completed',
            'delivery_date' => null
        ],
        [
            'id' => 4,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'pending',
            'delivery_date' => '2025-09-02 12:00:00'
        ],
        [
            'id' => 5,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'completed',
            'delivery_date' => null
        ],
        [
            'id' => 6,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'pending',
            'delivery_date' => '2025-09-03 06:25:00'
        ],
        [
            'id' => 7,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'completed',
            'delivery_date' => null
        ],
        [
            'id' => 8,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'pending',
            'delivery_date' => '2025-09-03 16:00:00'
        ],
        [
            'id' => 9,
            'name' => 'Levelup Lollipop',
            'quantity' => 1,
            'status' => 'completed',
            'delivery_date' => null
        ],
        [
            'id' => 10,
            'name' => 'Levelup Lollipop',
            'quantity' => 2,
            'status' => 'pending',
            'delivery_date' => '2025-09-06 05:00:00'
        ],
        [
            'id' => 11,
            'name' => 'Levelup Lollipop',
            'quantity' => 2,
            'status' => 'completed',
            'delivery_date' => null
        ],
        [
            'id' => 12,
            'name' => 'Levelup Lollipop',
            'quantity' => 2,
            'status' => 'pending',
            'delivery_date' => '2025-09-07 21:50:00'
        ]
    ];
    
    if (!is_dir('data')) {
        mkdir('data', 0777, true);
    }
    file_put_contents('data/stock_data.json', json_encode($initialData, JSON_PRETTY_PRINT));
}

$stockData = readStockData();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Stock Tracker - Levelup Lollipop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            padding: 20px;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 1000px;
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(30deg);
        }
        
        h1 {
            font-size: 32px;
            margin-bottom: 10px;
            position: relative;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .subtitle {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
        }
        
        .item-info {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
            background: linear-gradient(to right, #f8f9fa, white);
        }
        
        .item-icon {
            font-size: 40px;
            margin-right: 20px;
            color: #6a11cb;
            filter: drop-shadow(0 2px 4px rgba(106, 17, 203, 0.3));
        }
        
        .item-details h2 {
            color: #333;
            margin-bottom: 5px;
            font-size: 22px;
        }
        
        .item-details p {
            color: #666;
            font-size: 14px;
        }
        
        .stock-table-container {
            overflow-x: auto;
            padding: 0 20px;
        }
        
        .stock-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .stock-table th {
            background-color: #6a11cb;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .stock-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            color: #212529;
        }
        
        .stock-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .stock-table tr:hover {
            background-color: #e9ecef;
            transition: background-color 0.2s;
        }
        
        .stock-table tr:last-child td {
            border-bottom: none;
        }
        
        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .completed {
            background-color: #e6f7ee;
            color: #0abb92;
        }
        
        .pending {
            background-color: #fff4e5;
            color: #ff9f43;
        }
        
        .quantity {
            font-weight: 600;
            color: #6a11cb;
        }
        
        .date {
            color: #495057;
            font-weight: 500;
        }
        
        .countdown {
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .summary {
            padding: 20px;
            background-color: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e9ecef;
        }
        
        .total {
            font-size: 18px;
            color: #495057;
        }
        
        .total span {
            font-weight: 600;
            color: #6a11cb;
        }
        
        .admin-link {
            padding: 12px 24px;
            background-color: #6a11cb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .admin-link:hover {
            background-color: #4e0ba5;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .container {
                border-radius: 10px;
            }
            
            header {
                padding: 20px 15px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .item-info {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }
            
            .item-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .stock-table-container {
                padding: 0 10px;
            }
            
            .stock-table {
                font-size: 14px;
            }
            
            .stock-table th, 
            .stock-table td {
                padding: 10px;
            }
            
            .summary {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            .stock-table {
                display: block;
            }
            
            .stock-table th, 
            .stock-table td {
                padding: 8px 5px;
                font-size: 12px;
            }
            
            .status {
                padding: 4px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Item Stock Tracker</h1>
            <p class="subtitle">Monitor stok Levelup Lollipop</p>
        </header>
        
        <div class="item-info">
            <div class="item-icon">🍭</div>
            <div class="item-details">
                <h2>Levelup Lollipop</h2>
                <p>Item untuk meningkatkan level pets</p>
            </div>
        </div>
        
        <div class="stock-table-container">
            <table class="stock-table">
                <thead>
                    <tr>
                        <th width="15%">Status</th>
                        <th width="35%">Item</th>
                        <th width="30%">Tanggal</th>
                        <th width="20%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stockData as $item): ?>
                    <tr>
                        <td>
                            <span class="status <?= $item['status'] === 'completed' ? 'completed' : 'pending' ?>">
                                <?= $item['status'] === 'completed' ? 'Selesai' : 'Tertunda' ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>
                            <?php if ($item['delivery_date']): ?>
                            <div class="date"><?= date('j F Y, H:i', strtotime($item['delivery_date'])) ?></div>
                            <div class="countdown">
                                (<?php
                                $deliveryDate = new DateTime($item['delivery_date']);
                                $now = new DateTime();
                                $interval = $now->diff($deliveryDate);
                                if ($deliveryDate > $now) {
                                    echo "dalam {$interval->days} hari";
                                } else {
                                    echo "sudah lewat";
                                }
                                ?>)
                            </div>
                            <?php else: ?>
                            <div class="date">-</div>
                            <?php endif; ?>
                        </td>
                        <td><span class="quantity"><?= $item['quantity'] ?>x</span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="summary">
            <p class="total">Total Stok: <span>
                <?php
                $total = 0;
                foreach ($stockData as $item) {
                    $total += $item['quantity'];
                }
                echo $total . 'x Levelup Lollipop';
                ?>
            </span></a>
        </div>
    </div>

    <script>
        // JavaScript untuk efek visual tambahan
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi untuk baris tabel
            const tableRows = document.querySelectorAll('.stock-table tr');
            tableRows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 50);
            });
        });
    </script>
</body>
</html>