<?php 
	require 'vendor/db.php';

	$data = $_POST;

	function captcha_show(){
		$questions = array(
			1 => 'Столица России',
			2 => 'Столица США',
			3 => '2 + 3',
			4 => '15 + 14',
			5 => '45 - 10',
			6 => '33 - 3'
		);
		$num = mt_rand( 1, count($questions) );
		$_SESSION['captcha'] = $num;
		echo $questions[$num];
	}

	//если кликнули на button
	if ( isset($data['do_signup']) )
	{
    // проверка формы на пустоту полей
		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}

		if ( trim($data['email']) == '' )
		{
			$errors[] = 'Введите Email';
		}

		if ( $data['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}

		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'Повторный пароль введен не верно!';
		}

		//проверка на существование одинакового логина
		if ( R::count('users', "login = ?", array($data['login'])) > 0)
		{
			$errors[] = 'Пользователь с таким логином уже существует!';
		}
    
    //проверка на существование одинакового email
		if ( R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = 'Пользователь с таким Email уже существует!';
		}

		//проверка капчи
		$answers = array(
			1 => 'москва',
			2 => 'вашингтон',
			3 => '5',
			4 => '29',
			5 => '35',
			6 => '30'
		);
		if ( $_SESSION['captcha'] != array_search( mb_strtolower($_POST['captcha']), $answers ) )
		{
			$errors[] = 'Ответ на вопрос указан не верно!';
		}


		if ( empty($errors) )
		{
			//ошибок нет, теперь регистрируем
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
			R::store($user);
			echo '<div style="color:dreen;">Вы успешно зарегистрированы!</div><hr>';
		}else
		{
			echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
		}

	}

?>
<?php require_once('header.php') ?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="/signup.php" method="POST">
					<span class="login100-form-title p-b-26">
						Регистрация
					</span>
                <span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

                <div class="wrap-input100 validate-input" data-validate = "login">
                    <input class="input100" type="text" name="login" value="<?php echo @$data['login']; ?>">
                    <span class="focus-input100" data-placeholder="login"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="email" name="email" value="<?php echo @$data['email']; ?>">
                    <span class="focus-input100" data-placeholder="email"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="password" value="<?php echo @$data['password']; ?>">
                    <span class="focus-input100" data-placeholder="пароль"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100" type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
                    <span class="focus-input100" data-placeholder="повторите пароль"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <strong><?php captcha_show(); ?></strong>
                    <input class="input100" type="text" name="captcha"
                    <span class="focus-input100" data-placeholder="введите ответ"></span>
                </div>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit" name="do_signup">
                            Регистрация
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
