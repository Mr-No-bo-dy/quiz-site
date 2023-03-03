<?php
   require ("header.php");
   require ("function_admin.php");
?>

<div class="wrapper">
   <div class="flex">
      <div class="info">
         <h2>Welcome, <?= $nameAdmin ?></h2>
         <?php if ($imgAvaAdmin) { ?>
         <img class="ava" src="<?= $imgAvaAdmin ?>" alt="user_avatar">
         <?php } ?>
         <p>Your email: <b><?= $emailAdmin ?></b></p>
         <p>Your phone number: <b><?= $telAdmin ?></b></p>
      </div>
      <div class="buttons">
         <h3 style="margin-top: 35px"><a class="button" href="logout.php">Logout</a></h3>
      </div>
   </div>

   <?php //if (!isset($_POST['user_quiz'])) { ?>
   <div class="<?= $user_quiz_error ? 'users' : 'dn' ?>">
      <h2>All Users:</h2>
      <table class="allUsers">
         <thead>
            <tr>
               <th>Username</th><th>Email</th><th>Phone number</th><th>Avatar</th><th>Best Result</th><th>See All Results</th>
            </tr>
         </thead>
         <tbody>
         <?php foreach ($_SESSION['users'] as $key => $row) { ?>
            <tr>
               <td><?= $row['username'] ?></td>
               <td><?= $row['email'] ?></td>
               <td><?= $row['tel'] ?></td>
               <td>
                  <?php if (!empty($row['avatar'])) { ?>
                     <img class="ava" src="uploads/<?= $row['avatar'] ?>" alt="user_avatar">
                  <?php } ?>
               </td>
               <td>
                  <?= empty($row['quiz']) ? '' : $row['quiz'] . '%' ?>
               </td>
               <td>
                  <?php if (!empty($row['quiz'])) { ?>
                     <form action="" method="post">
                        <input type="hidden" name="user_quiz" value="<?= $row['username'] ?>">
                        <input type="submit" name="" value="Show Results">
                     </form>
                  <?php } ?>
               </td>
            </tr>
         <?php } ?>
         </tbody>
      </table>
   </div>
   <?php //} ?>

   <?php //if (isset($_POST['user_quiz'])) { ?>
   <div class="<?= $user_quiz_error ? 'dn' : 'users' ?>">
      <h2><?= $_POST['user_quiz'] ?>'s Quiz Results:</h2>
      <table class="quizResults">
         <thead>
            <tr>
               <th rowspan="2">Try</th><th rowspan="2">Username</th><th colspan="2">Results</th><th rowspan="2">Date</th>
            </tr>
            <tr>
               <th>Rights</th><th>Percentage</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($_SESSION[$_POST['user_quiz']]['quiz'] as $key => $row) { ?>
               <tr>
                  <td><?= $key ?></td>
                  <td><?= $row['username'] ?></td>
                  <td><?= $row['rights'] ?></td>
                  <td><?= $row['percent'] ?>%</td>
                  <td><?= $row['date'] ?></td>
               </tr>
            <?php } ?>
            <tr>
               <td><b>Average</b></td>
               <td><b><?= $row['username'] ?></b></td>
               <td><b><?= $_SESSION['averageUser']['rights'] ?></b></td>
               <td><b><?= $_SESSION['averageUser']['percent'] ?>%</b></td>
               <td><b> - </b></td>
            </tr>
         </tbody>
      </table>

      <form action="" method="post">
         <input type="submit" name="users_info" value="Show users">
      </form>

   </div>
   <?php //} ?>

   <!-- (Зараз відключено відображення класом 'dn') -->
   <?php //if (!isset($_POST['user_quiz'])) { ?>
   <div class="<?= $user_quiz_error ? 'dn' : 'dn' ?>">
      <h2>All Quiz Results:</h2>
      <table class="quizResults">
         <thead>
            <tr>
               <th rowspan="2">Try</th><th rowspan="2">Username</th><th colspan="2">Results</th><th rowspan="2">Date</th>
            </tr>
            <tr>
               <th>Rights</th><th>Percentage</th>
            </tr>
         </thead>
         <tbody>
         <?php foreach ($_SESSION['quiz'] as $key => $row) { ?>
            <tr>
               <td><?= $key ?></td>
               <td><?= $row['username'] ?></td>
               <td><?= $row['rights'] ?></td>
               <td><?= $row['percent'] ?>%</td>
               <td><?= $row['date'] ?></td>
            </tr>
         <?php } ?>
            <tr>
               <td><b>Average</b></td>
               <td><b>All</b></td>
               <td><b><?= $_SESSION['averageAll']['rights'] ?></b></td>
               <td><b><?= $_SESSION['averageAll']['percent'] ?>%</b></td>
               <td><b> - </b></td>
            </tr>
         </tbody>
      </table>
   </div>
   <?php //} ?>

</div>

<?php
   require ("footer.php");
?>
