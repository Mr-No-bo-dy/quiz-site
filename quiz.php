<?php
   require ("header.php");
   require_once ("functions.php");
   require ("function_quiz.php");
?>

<div>
   <h2>Welcome, <?= $_SESSION['users']['user']['username'] ?></h2>
   <p>This is PHP Quiz:</p>
</div>

<?php shuffle_assoc($quiz); ?>
<form class="quizForm" action="" method="post">
   <table>
      <?php $iterations = 5; ?>
      <?php $counter = 0; ?>           <!-- Attention! This $counter === (and MUST be equal to) $i (from 'function_quiz.php') -->
         <?php foreach ($quiz as $question => $allChoices) { ?>
            <?php $checked = 0; ?>
            <?php shuffle_assoc($allChoices); ?>
            <tr>
               <td colspan="4">
                  <h4><?= $question ?></h4>
                  <input type="hidden" name="question[<?= $counter ?>]" value="<?= $question ?>">
               </td>
            </tr>
            <tr>
            <?php foreach ($allChoices as $index => $choice) { ?>
               <td>
                  <label>
                     <input type="radio" name="answers[<?= $counter ?>]" value="<?= $choice ?>" <?= ($checked++ == 0) ? 'checked' : '' ?>><?= $choice ?>
                  </label>
               </td>
            <?php } ?>
            </tr>
            <?php $counter++; ?>
            <?php if ($counter >= $iterations) { ?>
               <?php break; ?>
            <?php } ?>
         <?php } ?>
   </table>
   <br>
   <button type="submit" name="completed">Complete Quiz</button>
</form>

<?php
   require ("footer.php");
?>
