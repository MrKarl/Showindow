<!DOCTYPE html lang="ko">
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/statics/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="/statics/css/style.css">

	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
	

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="/statics/js/bootstrap.min.js"></script>
	<script src="/assets/js/html5.js"></script>
	<script src="/assets/js/respond.js"></script>


	<link rel="stylesheet" href="/assets/src/jquery.remodal.css"> -->
  	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">


	<style>
				/*!
		 * Bootstrap Modal
		 *
		 * Copyright Jordan Schroter
		 * Licensed under the Apache License v2.0
		 * http://www.apache.org/licenses/LICENSE-2.0
		 *
		 * Boostrap 3 patch for for bootstrap-modal. Include BEFORE bootstrap-modal.css!
		 */

		body.modal-open, 
		.modal-open .navbar-fixed-top, 
		.modal-open .navbar-fixed-bottom {
		  margin-right: 0;
		}

		.modal {
		  left: 50%;
		  bottom: auto;
		  right: auto;
		  padding: 0;
		  width: 500px;
		  margin-left: -250px;
		  background-color: #ffffff;
		  border: 1px solid #999999;
		  border: 1px solid rgba(0, 0, 0, 0.2);
		  border-radius: 6px;
		  -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
		  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
		  background-clip: padding-box;
		}

		.modal.container {
		  max-width: none;
		}
	</style>

	<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" rel="stylesheet" />
	<link href="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.css" rel="stylesheet" />
	<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css" rel="stylesheet" />
	<link href="/assets/css/bootstrap-modal.css" rel="stylesheet" />

	<script src="/assets/js/bootstrap-modalmanager.js"></script>
	<script src="/assets/js/bootstrap-modal.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://getbootstrap.com/2.3.2/assets/js/google-code-prettify/prettify.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap.js"></script>
    <script src="/assetsjs/bootstrap-modalmanager.js"></script>
    <script src="/assetsjs/bootstrap-modal.js"></script>
    
	<script type="text/javascript">

	  $(function(){

	    $.fn.modalmanager.defaults.resize = true;

	    $('[data-source]').each(function(){
	      var $this = $(this),
	        $source = $($this.data('source'));

	      var text = [];
	      $source.each(function(){
	        var $s = $(this);
	        if ($s.attr('type') == 'text/javascript'){
	          text.push($s.html().replace(/(\n)*/, ''));
	        } else {
	          text.push($s.clone().wrap('<div>').parent().html());
	        }
	      });
	      
	      $this.text(text.join('\n\n').replace(/\t/g, '    '));
	    });

	    prettyPrint();
	  });
	</script>
	    

	<script id="dynamic" type="text/javascript">
	$('.dynamic .demo').click(function(){
	  var tmpl = [
	    // tabindex is required for focus
	    '<div class="modal hide fade" tabindex="-1">',
	      '<div class="modal-header">',
	        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
	        '<h3>Modal header</h3>', 
	      '</div>',
	      '<div class="modal-body">',
	        '<p>Test</p>',
	      '</div>',
	      '<div class="modal-footer">',
	        '<a href="#" data-dismiss="modal" class="btn">Close</a>',
	        '<a href="#" class="btn btn-primary">Save changes</a>',
	      '</div>',
	    '</div>'
	  ].join('');
	  
	  $(tmpl).modal();
	});
	</script>	
	<title>
		SHOWINDOW :: 당신의 스타일을 위하여
	</title>	

</head>
<body>
	<div class="page-container">

		<div>
			<button class="demo btn btn-primary btn-large" data-toggle="modal" href="#stack1">View Demo</button>
		</div>


		<div id="stack1" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		    <h3>Stack One</h3>
		  </div>
		  <div class="modal-body">
		    <p>One fine body…</p>
		    <p>One fine body…</p>
		    <p>One fine body…</p>
		    <input type="text" data-tabindex="1" />
		    <input type="text" data-tabindex="2" />
		    <button class="btn" data-toggle="modal" href="#stack2">Launch modal</button>
		  </div>
		  <div class="modal-footer">
		    <button type="button" data-dismiss="modal" class="btn">Close</button>
		    <button type="button" class="btn btn-primary">Ok</button>
		  </div>
		</div>

		<div id="stack2" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		    <h3>Stack Two</h3>
		  </div>
		  <div class="modal-body">
		    <p>One fine body…</p>
		    <p>One fine body…</p>
		    <input type="text" data-tabindex="1" />
		    <input type="text" data-tabindex="2" />
		    <button class="btn" data-toggle="modal" href="#stack3">Launch modal</button>
		  </div>
		  <div class="modal-footer">
		    <button type="button" data-dismiss="modal" class="btn">Close</button>
		    <button type="button" class="btn btn-primary">Ok</button>
		  </div>
		</div>

		<div id="stack3" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		    <h3>Stack Three</h3>
		  </div>
		  <div class="modal-body">
		    <p>One fine body…</p>
		    <input type="text" data-tabindex="1" />
		    <input type="text" data-tabindex="2" />
		  </div>
		  <div class="modal-footer">
		    <button type="button" data-dismiss="modal" class="btn">Close</button>
		    <button type="button" class="btn btn-primary">Ok</button>
		  </div>
		</div>

	</div>


</body>
</html>
