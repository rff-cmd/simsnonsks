<!--start check status online-->
<style>
	#status {
	  position: fixed;
	  width: 100%;
	  font: bold 1em sans-serif;
	  color: #FFF;
	  padding: 0.5em;
	}

	#log {
	  padding: 2.5em 0.5em 0.5em;
	  font: 1em sans-serif;
	}

	.online {
	  background: green;
	}

	.offline {
	  background: red;
	}
</style>

<?php /*
<script>
	window.addEventListener('load', function() {
	  var status = document.getElementById("status");
	  //var log = document.getElementById("log");

	  function updateOnlineStatus(event) {
	    var condition = navigator.onLine ? "online" : "offline";

	    status.className = condition;
	    status.innerHTML = condition.toUpperCase();

		if(status.innerHTML == "online".toUpperCase()) {
			//alert("online");
			//window.location = 'http://possp.sahabatputra.com';
		}
		
		if(status.innerHTML == "offline".toUpperCase()) {
			alert("offline");
			//window.location = 'http://localhost:8080/tokosahabat';
			window.location = 'http://localhost/tokosahabat';
		}
	    //log.insertAdjacentHTML("beforeend", "Event: " + event.type + "; Status: " + condition);
	  }

	  window.addEventListener('online',  updateOnlineStatus);
	  window.addEventListener('offline', updateOnlineStatus);
	});
</script>

<div id="status"></div>
<!--end check status online-->
*/ ?>


<div class="navbar-container" id="navbar-container">
	<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
		<span class="sr-only">&nbsp;</span>

		<span class="icon-bar"></span>

		<span class="icon-bar"></span>

		<span class="icon-bar"></span>
	</button>

	<div class="navbar-header pull-left">
		<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('main') ?>" class="navbar-brand">
			<small>
				<!--<i class="fa fa-leaf"></i>-->
				SIMS | SMAN 28 JAKARTA
			</small>
		</a>
	</div>

	<div class="navbar-buttons navbar-header pull-right" role="navigation">
		<ul class="nav ace-nav">
			
			<li class="light-blue">
				<a data-toggle="dropdown" href="#" class="dropdown-toggle">
					<!--<img class="nav-user-photo" src="app/photo_user/<?php echo $_SESSION['photo'] ?>" alt="Jason's Photo" />-->
					<!--<span class="user-info">-->
						<?php 
							if( isset($_SESSION["nama"]) == "") {
								echo $_SESSION["loginname"];
							} else {
								echo $_SESSION["nip"] . " " .$_SESSION["nama"];
							}							 
						?>
					<!--</span>-->

					<i class="ace-icon fa fa-caret-down"></i>
				</a>

				<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
					<?php if( isset($_SESSION["ganti_pwd_no"]) == 0) { ?>
						<li>
							<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('usr_change') ?>">
								<i class="ace-icon fa fa-cog"></i>
								Ganti Password
							</a>
						</li>
					<?php } ?>

					<li>
						<a href="#">
							<i class="ace-icon fa fa-user"></i>
							Profile
						</a>
					</li>

					<li class="divider"></li>

					<li>
						<a href="<?php echo $nama_folder ?>/<?php echo obraxabrix('logout') ?>">
							<i class="ace-icon fa fa-power-off"></i>
							Logout
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div><!-- /.navbar-container -->