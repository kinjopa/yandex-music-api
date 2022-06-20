<?php 
	require 'vendor/db.php';

	$data = $_POST;

	if (isset($data['do_login']))
	{
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ( $user )
		{
			//логин существует
			if ( password_verify($data['password'], $user->password) )
			{
				//если пароль совпадает, то нужно авторизовать пользователя
				$_SESSION['logged_user'] = $user;
				echo '<div style="color:dreen;">Вы авторизованы!<br/> Можете перейти на <a href="/">главную</a> страницу.</div><hr>';
			}else
			{
				$errors[] = 'Неверно введен пароль!';
			}

		}else
		{
			$errors[] = 'Пользователь с таким логином не найден!';
		}
		
		if ( ! empty($errors) )
		{
			//выводим ошибки авторизации
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>

<?php require_once('header.php') ?>
<!--<form action="login.php" method="POST">
	<strong>Логин</strong>
	<input type="text" name="login" value="<?php /*echo @$data['login']; */?>"><br/>

	<strong>Пароль</strong>
	<input type="password" name="password" value="<?php /*echo @$data['password']; */?>"><br/>

	<button type="submit" name="do_login">Войти</button>
</form>-->

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="login.php" method="POST">
					<span class="login100-form-title p-b-26">
						Добро пожаловать
					</span>
                <span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                    <input class="input100" type="text" name="login" value="<?php echo @$data['login']; ?>">
                    <span class="focus-input100" data-placeholder="Email"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="password" value="<?php echo @$data['password']; ?>">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit" name="do_login">
                            Вход
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-115">
						<span class="txt1">
							У вас ещё нет аккаунта?
						</span>

                    <a class="txt2" href="signup.php">
                        Регистрация
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>