<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>pizza input</title>
    <style>
      label, input[type="number"] {
        display: block;
        margin: 10px 0;
      }

      input[type="submit"] {
        margin-top: 20px;
      }
    </style>
  </head>
  <body>
    <h1>PIZZA</h1>
    <form method="post">
      <label for="페퍼로니">페퍼로니:</label>
      <input type="number" id="페퍼로니" name="페퍼로니" required><br>

      <label for="고구마">고구마:</label>
      <input type="number" id="고구마" name="고구마" required><br>

      <label for="하와이안">하와이안:</label>
      <input type="number" id="하와이안" name="하와이안" required><br>

      <label for="포테이토">포테이토:</label>
      <input type="number" id="포테이토" name="포테이토" required><br>

      <label for="치즈">치즈:</label>
      <input type="number" id="치즈" name="치즈" required><br>

      <input type="submit" value="Save Data">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // MySQL 데이터베이스 정보
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "pizza";

      // POST 방식으로 전송된 데이터 받기
      $페퍼로니 = $_POST["페퍼로니"];
      $고구마 = $_POST["고구마"];
      $하와이안 = $_POST["하와이안"];
      $포테이토 = $_POST["포테이토"];
      $치즈 = $_POST["치즈"];

      // 데이터베이스 연결
      $conn = new mysqli($servername, $username, $password, $dbname);

      // 연결 오류 체크
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      // 이전 데이터 삭제
      $sql = "DELETE FROM piechart_data";
      $conn->query($sql);
      // 데이터베이스에 데이터 추가
      $sql = "INSERT INTO piechart_data (페퍼로니, 고구마, 하와이안, 포테이토, 치즈)
      VALUES ('$페퍼로니', '$고구마', '$하와이안', '$포테이토', '$치즈')";

      if ($conn->query($sql) === TRUE) {
        echo "데이터 추가 완료!";
        } else {
        echo "데이터 추가 실패: " . $sql . "<br>" . $conn->error;
        } 
        $conn->close();
    }
    ?>
      </body>
    </html>
