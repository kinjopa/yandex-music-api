<?php 
	require 'db.php';
?>

<?php if ( isset ($_SESSION['logged_user']) ) : ?>
	Авторизован! <br/>
	Привет, <?php echo $_SESSION['logged_user']->login; ?>!<br/>

	<a href="logout.php">Выйти</a>

<?php else : ?>
Вы не авторизованы<br/>
<a href="/login.php">Авторизация</a>
<a href="/signup.php">Регистрация</a>
<?php endif; ?>

