<!DOCTYPE html>
<html>
<head>
	<? include("parts/head.php"); ?>
	<link rel="stylesheet" href="/site/html/css/entrance.css">
</head>

<body>

	<div class="custom_background">
		
	</div>

	<!-- header -->
	<header>
		<?  include("parts/header_general.php"); ?>
	</header>
	
	<style>
		
	</style>
	<div class="entrance_bg"></div>

	<div class="content clearfix inner">

		<div class="entrance_title">
			<h1 class="entrance_logo"></h2>
			<p>すべてのLGBTのためのSNS「イーチ」</p>
		</div>

		<? //if( $debug == 1 ){ ?>
		<!-- <div id="system_msg" style="background: #fff; padding: 1em 2em; border-radius: 4px; opacity: 0.8; margin: 0 auto; margin-bottom: 1em; font-size:80%; max-width: 620px;"> -->
			<? //echo ( $bean->get_system_msg() ); ?>
		<!-- </div> -->
	
		<? //} ?>


		<section class="entrance_box choice_new_or_login" style="background: none; text-align: center;">			
			<button id="join" class="btn_invisible btn_medium" value="0">アカウントを作る</button>
			<button id="login" class="btn_invisible btn_medium" value="1">ログインする</button>
		</section>


		<section class="entrance_box join">
			<h3>each「イーチ」ってなに？</h3>
			<div>
				
			</div>

			<h3>新規登録</h3>
			<form action="http://localhost/login.html?action=account_create" method="POST" accept-charset="utf-8">
				<p><input type="text" name="u_name" placeholder="アカウント名"></p>
				<p><input type="password" name="u_pass" placeholder="パスワード"></p>
				<p>captcha</p>
				<p><button type="submit" class="btn_green btn_full_widht">登録する</button></p>
			</form>
			<p class="right_align"><small><a href="" title="login" >登録済みの方はこちら&raquo;</a></small></p>
		</section>

		<div class="pipe"></div>

		<section class="entrance_box login">
			<h3>ログイン</h3>
			<form action="http://localhost/login.html?action=login_attempt" method="POST" accept-charset="utf-8">
				<p><input type="text" name="u_name" placeholder="アカウント名"></p>
				<p><input type="password" name="u_pass" placeholder="パスワード"></p>
				<p><button type="submit" class="btn_green btn_full_widht">ログイン</button></p>
			</form>
			<p class="right_align"><small><a href="" title="join">新規登録はこちら&raquo;</a></small></p>
		</section>

	</div>


	<script type="text/javascript">
		var block_choise = $(".choice_new_or_login");
		var block_join   = $(".join");
		var block_login  = $(".login");

		function switch_display_loginjoin( hidden, appear ) {
			hidden.animate( {opacity: "0"}, 320 );
			setTimeout(function(){ hidden.css( "display", "none" ) }, 320);
			setTimeout(function(){ appear.css( "display", "block" ) }, 320);
			setTimeout(function(){ appear.animate( {opacity: "1"}, 320 ) }, 320);;
		}

		function general_cookie( cookie_name, value, exdays ) {
			var expires_date = new Date();
			expires_date.setTime(expires_date.getTime()+(exdays*24*60*60*1000));	
			var parts_hostname = location.hostname.split(".");
			var domain = parts_hostname.slice(-2).join(".");
			docCookies.setItem( cookie_name, value, expires_date, "/", domain );
		}


		if( docCookies.getItem(cookie_name) ) {
			block_login.css( "display", "block" );
			block_login.css( "opacity", "1" );

		} else {
			block_choise.css( "display", "block" );
			block_choise.css( "opacity", "1" );
		}


		block_choise.children("button").on('click',function() {
			if ( $(this).attr("value") == "0" ) {
				switch_display_loginjoin( block_choise, block_join );

			} else if ( $(this).attr("value") == "1" ) {
				switch_display_loginjoin( block_choise, block_login );
				general_cookie('each_joinlogin', 1, 7);
			}
		});



		$(".entrance_box a").on('click',function( a_event ) {
			a_event.preventDefault();

			if ( $(this).attr("title") == "login" ) {
				switch_display_loginjoin( block_join, block_login );

			} else if ( $(this).attr("title") == "join" ) {
				switch_display_loginjoin( block_login, block_join );
			}
		});


		$('form').submit(function(){
		    return false;
		});



		$('.entrance_box form button').click( function() {
			var u_name_val = $(this).parents('form').find('input[type=text]').val();
			var u_pass_val = $(this).parents('form').find('input[type=password]').val();
			var session_id_val = '<? echo $session_id; ?>';
		

			var user_info = { "u_name" : u_name_val, "u_pass" : u_pass_val, "session_id" : session_id_val };

			$.ajax({
				type: 'POST',
				url: 'http://localhost/login.html?action=login_attempt',
				dataType: 'json',
				data: user_info,
				error: function() {
					console.log('error');
				},
				success: function ( json ) {
					if( json.status == 1 ) {
						general_cookie('each_login', 1, 7);
						window.location.replace('http://localhost');
					}
				}

			});

		});
	</script>

	<!-- footer -->
	<footer>
		<? include("parts/footer.php"); ?>
	</footer>

</body>
</html>