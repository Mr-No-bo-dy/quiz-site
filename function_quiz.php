<?php
   echo '<pre>';
   session_start();
   $currentUser = $_SESSION['users']['user']['username'];

   // Всі питання тестів:
   $quiz = [
      'Чому \n не переносить рядок?' => 
      [
         0 => 'Я не знаю',
         'Ніхто не знає',
         'Знаю, але не скажу',
         '[Підійти і сказати]',
      ],
      'Який цикл найкраще підходить для опису гомо сапіенс?' => 
      [
         0 => 'do-while',
         'while',
         'for',
         'foreach',
      ],
      'Скільки всього існує щасливих квитків у 6-значних номерах' => 
      [
         0 => '55252',
         '25640',
         '32768',
         '65536',
      ],
      'Яка функція використовується для зчитування вмісту файлу?' => 
      [
         0 => 'readfile()',
         'openfile()',
         'openf()',
         'fopen()',
      ],
      'Яка функція використовується для виведення тексту на екран?' => 
      [
         0 => 'echo',
         'print',
         'print_r',
         'display',
      ],
      'Який оператор використовується для перевірки чи змінна містить значення?' => 
      [
         0 => 'isset()',
         'is()',
         'is_null()',
         'empty()',
      ],
      'Яка функція використовується для видалення пробілів з початку та кінця рядка?' => 
      [
         0 => 'trim()',
         'strip()',
         'remove_space()',
         'remove_whitespace()',
      ],
      'Яка функція використовується для заміни підрядка у рядку?' => 
      [
         0 => 'str_replace()',
         'substr_replace()',
         'replace()',
         'substr()',
      ],
      'Який з даних операторів використовується для видалення елементу з масиву за ключем?' => 
      [
         0 => 'unset()',
         'die()',
         'remove()',
         'delete()',
      ],
      'Яка функція використовується для перетворення рядка в масив?' => 
      [
         0 => 'explode()',
         'split()',
         'to_array()',
         'string_to_array()',
      ],
   ];

   // Перемішування масиву всіх питань і вибір з них потрібної кількості рандомних:
   $quizDone = [];
   shuffle_assoc($quiz);
   $iterations = 5;        // Кількість питань для тестів
   $counter = 0;
   foreach ($quiz as $question => $allChoices) {
      shuffle_assoc($allChoices);
      $quizDone[$question] = $allChoices;
      $counter++;
      if ($counter >= $iterations) {
         break;
      }
   }
   echo '</pre>';

   // Якщо тест завершено: Опрацювання, Зберігання рез-тів і Перенаправлення на Головну:
   if (isset($_POST['completed'])) {

      // Опрацювання проходження тестів:
      if (isset($_POST['answers'])) {
         $countRightAnswers = 0;
         foreach ($quiz as $question => $allChocies) {
            for ($i = 0; $i <count($_POST['question']); $i++) {
               if ($question == $_POST['question'][$i]) {
                  if ($allChocies[0] == $_POST['answers'][$i]) {     // Attention! This $i === (and MUST be equal to) $counter (from 'quiz.php')
                     $countRightAnswers++;
                  }
               }
            }
         }
         $_SESSION['current']['rights'] = $countRightAnswers;
         $_SESSION['current']['percent'] = ($countRightAnswers / count($_POST['answers'])) * 100;
         $_SESSION['current']['date'] = date('Y.m.d H:i:s');
      }
      
      // Запис результату тестів в масив:
      $quizResults = [
         $currentUser,
         $_SESSION['current']['rights'],
         $_SESSION['current']['percent'],
         $_SESSION['current']['date'],
      ];

      // Читання 'БД' Юзерів:
      $file = 'users';
      $users = file_read($file);

      $usersData = [];
      foreach ($users as $row) {
         // Перевірка Юзернейма і Запис його рез-тів Тестів в .csv файл:
         if ($currentUser == $row[0]) {
            $fileQuiz = 'quiz';
            file_write($fileQuiz, $quizResults);
         }
      }
      header('Location: index.php');
   }
?>
