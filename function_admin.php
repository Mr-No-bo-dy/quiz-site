<?php 
   echo '<pre>';
   session_start();

   // If ADMIN:
   if(isset($_SESSION['users']['admin'])) {
      $nameAdmin = $_SESSION['users']['admin']['username'];
      $emailAdmin = $_SESSION['users']['admin']['email'];
      $telAdmin = $_SESSION['users']['admin']['tel'];

      // Вивід Аватари:
      $imgAvaAdmin = '';
      if ($_SESSION['users']['admin']['avatar']) {
         $imgAvaAdmin = 'uploads/' . $_SESSION['users']['admin']['avatar'];
      } else {
         $imgAva = 'uploads/_no_ava.png';
      }

      // Запис результатів тестів всіх юзерів:
      $fileUsers = 'users';
      $users = file_read($fileUsers);
      $fileQuiz = 'quiz';
      $results = file_read($fileQuiz);
      
      // Запис лише кращих результатів тестів всіх юзерів:
      $quizResults = [];
      foreach ($results as $row) {
         if (empty($quizResults[$row[0]]) || ($quizResults[$row[0]] < $row[2])) {
            $quizResults[$row[0]] = $row[2];
         }
         foreach ($quizResults as $key => $val) {
            if ($key == $row[0]) {
               $_SESSION['users'][$row[0]]['quiz'] = $val;
            }
         }
      }

      // Запис всіх результатів тестів всіх юзерів:      (Зараз відключено відображення в 'admin.php' класом 'dn')
      $rightsSumAll = 0;
      $percentSumAll = 0;
      for ($i = 0; $i < count($results); $i++) {
         $_SESSION['quiz'][$i+1]['index'] = $i+1;
         $_SESSION['quiz'][$i+1]['username'] = $results[$i][0];
         $_SESSION['quiz'][$i+1]['rights'] = $results[$i][1];
         $_SESSION['quiz'][$i+1]['percent'] = $results[$i][2];
         $_SESSION['quiz'][$i+1]['date'] = $results[$i][3];
         $rightsSumAll += $results[$i][1];
         $percentSumAll += $results[$i][2];
      }
      if (!empty($results)) {
         $_SESSION['averageAll']['rights'] = round($rightsSumAll / (count($results)), 1);
         $_SESSION['averageAll']['percent'] = round($percentSumAll / (count($results)), 1);
      }
      
      // Якщо НЕ клікнули глянути рез-ти тестів певного юзера, не виводить їх:
      $user_quiz_error = true;
      $all_quiz = false;
      if(isset($_POST['user_quiz'])) {
         $user_quiz_error = false;
         $j = 1;
         $rightsSumUser = 0;
         $percentSumUser = 0;
         for ($i = 0; $i < count($results); $i++) {
            if ($results[$i][0] == $_POST['user_quiz']) {
               $_SESSION[$_POST['user_quiz']]['quiz'][$j]['username'] = $results[$i][0];
               $_SESSION[$_POST['user_quiz']]['quiz'][$j]['rights'] = $results[$i][1];
               $_SESSION[$_POST['user_quiz']]['quiz'][$j]['percent'] = $results[$i][2];
               $_SESSION[$_POST['user_quiz']]['quiz'][$j]['date'] = $results[$i][3];
               $rightsSumUser += $results[$i][1];
               $percentSumUser += $results[$i][2];
               $_SESSION['averageUser']['rights'] = round($rightsSumUser / $j, 1);
               $_SESSION['averageUser']['percent'] = round($percentSumUser / $j, 1);
               $j++;
            }
         }
      }

      // Якщо клікнули на сторінку рез-тів тестів  - вивести назад інфо про всіх юзерів:
      if(isset($_POST['users_info'])) {
         $user_quiz_error = true;
      }

      // Якщо клікнули показати всі рез-ти тестів  - вивести інфо про всі рез-ти тестів всіх юзерів:
      if(isset($_POST['all_quiz'])) {
         $all_quiz = true;
      }
      
   } else {
      header("Location: login.php");
   }
   
   echo '</pre>'; ?>