<?php
   require ("header.php");
   require ("function_index.php");
?>

<div class="wrapper">
   <div class="flex">
      <div class="info">
         <h2>Welcome, <?= $name ?></h2>
         <?php if ($imgAva) { ?>
         <p>I know that you look like this:</p>
         <img class="ava" src="<?= $imgAva ?>" alt="user_avatar">
         <?php } ?>
         <p>Your email is: <b><?= $email ?></b></p>
         <p>Your phone number is: <b><?= $tel ?></b></p>
      </div>
      <div class="buttons">
         <h3 style="margin-top: 35px"><a class="button" href="logout.php">Logout</a></h3>
         <h3><a class="button" href="quiz.php">Start a PHP quiz</a></h3>
      </div>
   </div>
   <hr>
   <div class="flex">
      <?php if (!empty($errorText)) { ?>
         <p class="error-unique"><?= $errorText ?></p>
      <?php } ?>
      <div class="<?= $quizError ? 'dn' : '' ?>">
         <h3>All of your quiz results:</h3>
         <table class="quizResults">         <!-- Вивід результатів всіх тестів: -->
            <thead>
               <tr>
                  <th rowspan="2">Try</th><th colspan="2">Results</th><th rowspan="2">Date</th>
               </tr>
               <tr>
                  <th>Rights</th><th>Percentage</th>
               </tr>
            </thead>
            <tbody>
            <?php $index = 1; ?>
            <?php foreach ($_SESSION['quiz'] as $results) { ?>
               <tr>
                  <td><?= $index ?></td>
                  <td><?= $results['rights'] ?></td>
                  <td><?= $results['percent'] ?>%</td>
                  <td><?= $results['date'] ?></td>
               <?php $index++; ?>
               </tr>
            <?php } ?>
               <tr>
                  <td><b>Average</b></td>
                  <td><b><?= $_SESSION['average']['rights'] ?></b></td>
                  <td><b><?= $_SESSION['average']['percent'] ?>%</b></td>
                  <td> - </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div class="start-quiz">      <!-- Вивід результатів останнього тесту: -->
         <?php if (isset($_SESSION['current'])) { ?>
            <h3>Your quiz result:</h3>
            <p>You gave <b><?= $_SESSION['current']['rights'] ?></b> right answers.</p>
            <p>Your performance rate: <b><?= $_SESSION['current']['percent'] ?>%</b>.</p>
         <?php } ?>
      </div>
   </div>
   <hr>

</div>

<?php
   require ("footer.php");
?>
