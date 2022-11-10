<?php $var = 1; ?>

<form action="accueil.php" method="POST">
<input type="hidden" name="idCompte" value = <?php echo $var; ?>>
<button type='submit'> ACCUEIL </button>
</form>