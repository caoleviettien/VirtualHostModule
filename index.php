<?php
	 session_start();
	 include "./app/check.php";
	 $check = new checkFile();
	 $checkVhost = null;
	 $checkPath = null;
	 $urlold = null;
	 $linkold = null;
	 $driveold = null;

	if (isset($_POST['url']) & isset($_POST['linkpj']) & isset($_POST['drive'])) {
	    $checkVhost = $check->checkvhost($_POST['url'], $_POST['linkpj'], $_POST['drive']);
	}
	if (isset($_POST['url'])) {
	    $checkPath = $check->checkPath($_POST['url']);
	}

	if ($_POST) {
	    $_SESSION["url"] = $_POST["url"];
	    $_SESSION["linkpj"] = $_POST["linkpj"];
	    $_SESSION["drive"] = $_POST["drive"];
	}

	if (isset($_SESSION["url"]) & isset($_SESSION["linkpj"]) & isset($_SESSION["drive"])) 
	{
		$urlold = $_SESSION["url"];
		$linkold = $_SESSION["linkpj"];
		$driveold = $_SESSION["drive"];
	}
		
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Create VirtualHost</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" type="text/css" href="./public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./public/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./public/js/bootstrap.min.js">
	<link rel="stylesheet" type="text/css" href="./public/js/jquery-2.1.4.min.js">
	<style type="text/css" media="screen">
		body {
			background: url("./public/images/background.jpg");
			color: #fff;
		}
		input[type="text"]
		{
		    background: transparent;
		    border: 0.11em #fff solid;
		    color: #fff;
		    font-style: italic;
		}
		.form-group textarea {
		  	background: transparent;
		    border: 0.11em #fff solid;
		    color: #fff;
		    font-style: italic;
		}
		.form-group  select{
		  	background: transparent;
		    border: 0.11em #fff solid;
		    color: #fff;
		    font-style: italic;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>CREATE VIRTUALHOST</h2>
		<div class="row">
			<div class="col-xs-6">
				<form name="createform" method="POST" onsubmit="return validateForm()">
					  <div class="form-group">
					    <label for="url">Input URL:</label>
					    <input value="<?php if ($urlold){ echo $urlold; } ?>" type="text" class="form-control" name="url" id="url" placeholder="Enter URL VirtualHost...">
					    <small class="form-text text-muted">This is URL project you can run by VirtualHost</small>
					  </div>

					  <div class="form-group">
					    <label for="linkpj">Project Address</label>
					    <input value="<?php if ($linkold){ echo $linkold; } ?>" type="text" class="form-control" name="linkpj" id="linkpj" placeholder="Enter Your Project Address...">
					    <small class="form-text text-muted">This is Your Project Address</small>
					  </div>

					  <div class="form-group">
					  	<label for="drive">Virtual server installation drive</label>
					    <select id="drive" name="drive" class="form-control" required="required">
					    	<option style="color: #000;" value="C"  <?php echo $driveold == "C" ? 'selected' : '' ?> >C:</option>
					    	<option style="color: #000;" value="D"  <?php echo $driveold == "D" ? 'selected' : '' ?> >D:</option>
					    	<option style="color: #000;" value="E"  <?php echo $driveold == "E" ? 'selected' : '' ?> >E:</option>
					    	<option style="color: #000;" value="F"  <?php echo $driveold == "F" ? 'selected' : '' ?> >F:</option>
					    	<option style="color: #000;" value="G"  <?php echo $driveold == "G" ? 'selected' : '' ?> >G:</option>
					    	<option style="color: #000;" value="H"  <?php echo $driveold == "H" ? 'selected' : '' ?> >H:</option>
					    </select>						        	
					  </div>

					  	<div class="form-group">
						    <label for="vhost">File httpd-vhost.conf:</label>
						    <textarea class="form-control" name="vhost" id="vhost" rows="10">
						    	<?php if ($checkVhost){ echo $checkVhost; } ?>						     		
						    </textarea>
						</div>

						<div class="form-group">
						    <label for="path">Path hosts</label>
						    <textarea value="add" class="form-control" name="path" id="path" rows="2"><?php if ($checkPath){ echo $checkPath; } ?></textarea>
						</div>
					  <button formaction="./app/create.php" name="submit" type="submit" class="btn btn-primary">Create</button>
					  <button formaction="index.php" name="check" type="submit" class="btn btn-success">Check</button>
				</form>
			</div>
		</div>		
	</div>

	<script language="javascript">
		function validateForm()
			{
			    // Bước 1: Lấy giá trị của url và linkpj
			    var url = document.getElementById('url').value;
			    var linkpj = document.getElementById('linkpj').value;
			 
			    // Bước 2: Kiểm tra dữ liệu hợp lệ hay không
			    if (url == ''){
			        alert('Bạn chưa nhập Input URL');
			    }
			    else if (linkpj == '')
			    {
			        alert('Bạn chưa nhập Project Address');
			    }
			    else{
			        //alert('Dữ liệu hợp lệ, ta có thể chấp nhận submit form');
			        return true;
			    }			 
			    return false;
			}

	</script>	
</body>
</html>