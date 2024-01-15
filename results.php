<?php
// データファイルを読み取り、星の評価を集計する
$ratings = array_fill(1, 5, 0); // 1から5までの評価で初期化
$totalRatings = 0; // 総評価数
$responses = []; // アンケートの応答を格納する配列

$data = file("responses.txt");
foreach ($data as $line) {
    list($name, $email, $rating) = explode(",", $line);
    $name = trim(explode(":", $name)[1]);
    $email = trim(explode(":", $email)[1]);
    $rating = trim(explode(":", $rating)[1]);

    // 名前、メールアドレス、評価を配列に追加
    $responses[] = ['name' => $name, 'email' => $email, 'rating' => $rating];

    if (isset($ratings[$rating])) {
        $ratings[$rating]++;
        $totalRatings++;
    }
}

// 各評価のパーセンテージを計算
$percentageRatings = array_map(function($count) use ($totalRatings) {
    return ($totalRatings > 0) ? round(($count / $totalRatings) * 100, 2) : 0;
}, $ratings);
?>

<!DOCTYPE html>
<html>
<head>
    <title>アンケート結果</title>
    <!-- Chart.jsの追加 -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>アンケート結果</h1>

    <!-- 星の評価グラフ -->
    <div style="width: 60%; margin: auto;">
        <canvas id="ratingChart"></canvas>
    </div>

    <!-- 名前、Email、評価の表 -->
    <h2>応答者の情報</h2>
    <table border="1" style="width: 100%; margin-top: 20px;">
        <tr>
            <th>名前</th>
            <th>Email</th>
            <th>評価</th>
        </tr>
        <?php foreach ($responses as $response) : ?>
            <tr>
                <td><?php echo htmlspecialchars($response['name']); ?></td>
                <td><?php echo htmlspecialchars($response['email']); ?></td>
                <td><?php echo htmlspecialchars($response['rating']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        var ctx = document.getElementById('ratingChart').getContext('2d');
        var ratingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['1星', '2星', '3星', '4星', '5星'],
                datasets: [{
                    label: '星の評価 (%)',
                    data: [<?php echo implode(',', $percentageRatings); ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }
    });
</script>
</body>
</html>