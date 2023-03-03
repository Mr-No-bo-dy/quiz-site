<?php echo '<pre>';
   try {
      $action = '';
      $error = false;
      $userUniqueError = false;
      $errorText = '';
      if (!empty($_POST)) {
         if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['tel'])) {
            $error = true;
            throw new Exception("Заповнені не всі поля");
         } else {
            // Читання простої 'БД' Юзерів:
            $file = 'users';
            $users = file_read($file);
            
            // Формування асоціативної 'БД' Юзерів:
            $usersData = [];
            foreach ($users as $row) {
               $usersData['users'][$row[0]]['username'] = $row[0];
               $usersData['users'][$row[0]]['password'] = $row[1];
               $usersData['users'][$row[0]]['email'] = $row[2];
               $usersData['users'][$row[0]]['tel'] = $row[3];
               $usersData['users'][$row[0]]['avatar'] = $row[4];
            }

            // Перевірка на Унікальність:
            foreach ($usersData['users'] as $key => $val) {
               if ($key == $_POST['username']) {
                  $userUniqueError = true;
                  throw new Exception("Такий Юзернейм вже зареєстрований");
               }
            }

            $function_registrer = 'function_registrer';
            if (!$userUniqueError) {
               registration($function_registrer);
            }
         }
      }

   } catch (Exception $e) {
      $errorText = $e->getMessage();
   }
   echo '</pre>';