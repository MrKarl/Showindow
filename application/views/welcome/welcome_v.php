<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="/favicon.ico">
	<style>
		* {
			background-color : ##e0ffff;
		}

	</style>
	<script>
		
	</script>
	<title>SHOWINDOW :: 패션의 중심</title>
</head>

<body>
	<div id="wrap">
		<div id='header'>
			<img src="http://54.238.154.75/assets/showindowWithICON.png" id='logo'>			
		</div>

		<div id='text_adver'>
			<h2><span id="brandname">SHOWINDOW</span>  щ遺룹留대낫몄 !</h2>
		</div>

		<div id='loginbox'>
			<table>
				<tr>
					<td>ㅻ 怨쇰 濡렇/td>
					<td><button value="HELLO">Facebook</button></td>
				</tr>
				
				<tr>
					<td>대쇰 濡렇/td>
					<td><button value="HELLO">E-mail</button></td>
				</tr>
				
				<tr>
					<td colspan="2">媛린</td>
				</tr>
			</table>
		</div>

		<div id='introduce'>
			<h4>쇱쇱 댄 ㅻ щ遺寃몃
			肄瑜留땄濡났 異⑸ щ遺媛怨
			  ⑥ 猷⑸ 異⑸<br/>
			吏 諛 濡렇명몄!</h4>
		</div>


		<div id="fb-root"></div>
		<script>
		  window.fbAsyncInit = function() {
		  FB.init({
		    appId      : '275654995924578',
		    status     : true, // check login status
		    cookie     : true, // enable cookies to allow the server to access the session
		    xfbml      : true  // parse XFBML
		  });

		  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
		  // for any authentication related change, such as login, logout or session refresh. This means that
		  // whenever someone who was previously logged out tries to log in again, the correct case below 
		  // will be handled. 
		  FB.Event.subscribe('auth.authResponseChange', function(response) {
		    // Here we specify what we do with the response anytime this event occurs. 
		    if (response.status === 'connected') {
		      // The response object is returned with a status field that lets the app know the current
		      // login status of the person. In this case, we're handling the situation where they 
		      // have logged in to the app.
		      alert("페북가입o/앱가입O");
		      testAPI();
		    } else if (response.status === 'not_authorized') {
		      alert("페북가입o/앱가입x");
		      // In this case, the person is logged into Facebook, but not into the app, so we call
		      // FB.login() to prompt them to do so. 
		      // In real-life usage, you wouldn't want to immediately prompt someone to login 
		      // like this, for two reasons:
		      // (1) JavaScript created popup windows are blocked by most browsers unless they 
		      // result from direct interaction from people using the app (such as a mouse click)
		      // (2) it is a bad experience to be continually prompted to login upon page load.
		      FB.login();
		    } else {
		    	alert("페북가입X/앱가입x");
		      // In this case, the person is not logged into Facebook, so we call the login() 
		      // function to prompt them to do so. Note that at this stage there is no indication
		      // of whether they are logged into the app. If they aren't then they'll see the Login
		      // dialog right after they log in to Facebook. 
		      // The same caveats as above apply to the FB.login() call here.
		      FB.login();
		    }
		  });
		  };

		  // Load the SDK asynchronously
		  (function(d){
		   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		   if (d.getElementById(id)) {return;}
		   js = d.createElement('script'); js.id = id; js.async = true;
		   js.src = "//connect.facebook.net/en_US/all.js";
		   ref.parentNode.insertBefore(js, ref);
		  }(document));

		  // Here we run a very simple test of the Graph API after login is successful. 
		  // This testAPI() function is only called in those cases. 
		  function testAPI() {
		    console.log('Welcome!  Fetching your information.... ');
		    FB.api('/me', function(response) {
		      console.log('Good to see you, ' + response.name + '.');
		    });
		  }
		</script>

		<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>

	</div>
</body>
</html>