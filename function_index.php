<?php echo '<pre>';
   session_start();

   // If USER:
   if (isset($_SESSION['users']['user'])) {
      $quizError = true;
      $errorText = '';
      $name = $_SESSION['users']['user']['username'];
      $email = $_SESSION['users']['user']['email'];
      $tel = $_SESSION['users']['user']['tel'];

      // Вивід Аватари:
      $imgAva = '';
      if ($_SESSION['users']['user']['avatar']) {
         $imgAva = 'uploads/' . $_SESSION['users']['user']['avatar'];
      } else {
         $imgAva = 'uploads/_no_ava.png';
      }

      // Запис результатів тестів юзера, що залогінився:
      $fileQuiz = 'quiz';
      $results = file_read($fileQuiz);
      $index = 1;
      $rightsSum = 0;
      $percentSum = 0;
      foreach ($results as $row) {
         if ($_SESSION['users']['user']['username'] == $row[0]) {
            $_SESSION['quiz'][$index]['rights'] = $row[1];
            $_SESSION['quiz'][$index]['percent'] = $row[2];
            $_SESSION['quiz'][$index]['date'] = $row[3];
            $rightsSum += $row[1];
            $percentSum += $row[2];
            $_SESSION['average']['rights'] = round($rightsSum / $index, 1);
            $_SESSION['average']['percent'] = round($percentSum / $index, 1);
            $index++;
         }
      }

      // Заглушка і повідомлення, якщо Тест ще НЕ проходили:
      try {
         if (isset($_SESSION['quiz'])) {
            $quizError = false;
         } else {
            // echo "<h2 style='color: red'>Ви ще НЕ проходили тести. Пройдіть, інакше вас виженуть з Універа!</h2>";
            throw new Exception("Ви ще НЕ проходили тести. Пройдіть, інакше вас виженуть з Універа!");
         }
      } catch (Exception $e) {
         $errorText = $e->getMessage();
      }
      
   } else {
      header("Location: login.php");
   }
   
   echo '</pre>'; ?>