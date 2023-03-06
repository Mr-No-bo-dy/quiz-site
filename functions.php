<?php 
   // echo '<pre>';

   // Підключення файлу та виконання власне реєстрації:
   function registration($reg, array $userData = []) {
      require_once($reg . '.php');
   }

   // Читання з Файлу:
   function file_read($filename, $data = [], $mode = 'r') {
      $file = 'csv/' . $filename . '.csv';
      $streamR = fopen($file, $mode);
      while (($info = fgetcsv($streamR)) !== false) {
         $data[] = $info;
      }
      fclose($streamR);
      return $data;
   }

   // Запис в Файл:
   function file_write($filename, $data = [], $mode = 'a') {
      $file = 'csv/' . $filename . '.csv';
      $streamA = fopen($file, $mode);
      fputcsv($streamA, $data);
      fclose($streamA);
      return true;
   }

   // Перемішування масиву зі збереженням ключів:
   function shuffle_assoc(&$array) {
      $keys = array_keys($array);
      shuffle($keys);
      foreach($keys as $key) {
         $new[$key] = $array[$key];
      }
      $array = $new;
      return true;
   }


      // NOT USED FUNCTIONS:
   // Перебір масиву:
   function read_array($arrayInd, $row, $arrayAsoc = []) {
      // $arrayAsoc = [];
      foreach ($arrayInd as $row) {
         $arrayAsoc['users'][$row[0]]['username'] = $row[0];
         $arrayAsoc['users'][$row[0]]['password'] = $row[1];
         $arrayAsoc['users'][$row[0]]['email'] = $row[2];
         $arrayAsoc['users'][$row[0]]['tel'] = $row[3];
         $arrayAsoc['users'][$row[0]]['avatar'] = $row[4];
      }
      return $arrayAsoc;
   }
   
   // html-таблиця для простого 2-вимірного масиву:
   function table_quiz_results($doubleArray, $index = null) {
      $index = 1;
      foreach ($doubleArray as $array) { ?>
         <tr>
            <td><?= $index ?></td>
            <td><?= $array['rights'] ?></td>
            <td><?= $array['percent'] ?></td>
            <td><?= $array['date'] ?></td>
         <?php $index++; ?>
         </tr>
      <?php }
   }

   // echo '</pre>';
?>