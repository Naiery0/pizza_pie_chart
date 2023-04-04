<?php
// MySQL 데이터베이스 정보
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 오류 체크
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 데이터베이스에서 데이터 가져오기
$sql = "SELECT * FROM piechart_data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 데이터 배열 초기화
    $data = array(
        array('Pizza', 'Slices')
    );

    // 데이터 배열에 데이터 추가
    while($row = $result->fetch_assoc()) {
        $data[] = array('페퍼로니', (int)$row['페퍼로니']);
        $data[] = array('고구마', (int)$row['고구마']);
        $data[] = array('하와이안', (int)$row['하와이안']);
        $data[] = array('포테이토', (int)$row['포테이토']);
        $data[] = array('치즈', (int)$row['치즈']);
    }

    // JSON 형식으로 데이터 출력
    $jsonData = json_encode($data);

    // 구글 파이차트 출력
    echo '<html>
            <head>
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
              <script type="text/javascript">
                google.charts.load("current", {"packages":["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                  var data = google.visualization.arrayToDataTable(' . $jsonData . ');

                  var options = {
                    title: "Pizza",
                    pieHole: 0.4,
                  };

                  var chart = new google.visualization.PieChart(document.getElementById("piechart"));
                  chart.draw(data, options);
                }
              </script>
            </head>
            <body>
              <div id="piechart" style="width: 900px; height: 500px;"></div>
            </body>
          </html>';

} else {
    echo "0 results";
}

// 데이터베이스 연결 종료
$conn->close();
?>
