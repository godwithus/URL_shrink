<?php

include_once 'func.php';

////////////////////////////////////////////////////////////////////////////////////////////////////////
/////// This is were the logic of redirecting the short link to it original page
/////// THe rand parameter was not showing in the URL bar because we have re-write it with .htaccess
////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['rand'])){													
	$rand = preg_replace('#[^a-zA-Z0-9]#i', '', trim($_GET['rand']));
    
    // Check if that rand number is in Database
    $sql = mysqli_query($con, "SELECT original_link FROM url_shortner WHERE new_link = '$rand'");
    $check = mysqli_num_rows($sql);
    
    if($check > 0){
        
        // Fetch the data related to the Rand value
        $fetch = mysqli_fetch_assoc($sql);
    
        $id = $fetch['original_link'];
		header('Location: '.$id.'');
		
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
//////// We end the logic here
////////////////////////////////////////////////////////////////////////////////////////////////////////

$err = '';
$success = '';
$new_link_gen = '';

if(isset($_POST['submit'])){
	
	$short_value = htmlspecialchars($_POST['shortner']);
	
	if($short_value != ''){
		
		$new_link = randomString();
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		// Over Here we look if The User as set the the name they decide to use for there short link ////
		////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////
		
		if($_POST['choose_addr'] != ''){
			$choose_address = $_POST['choose_addr'];
			
			if (!preg_match("/^[a-zA-Z0-9]*$/", $choose_address)) {
				$err = "Only Alphabet and Numbers Allowed";
			}else{
				$sql = "SELECT * FROM url_shortner WHERE new_link = '$choose_address'";
				$query = mysqli_query($con, $sql);

				$count = mysqli_num_rows($query);
				
				if($count > 0){
					$err = "Specify name for your URL already exist";
				}else{
					$new_link = $choose_address;
				}
			}
		}
		
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////// We end the logic here
		////////////////////////////////////////////////////////////////////////////////////////////////////////


		
				
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//        Here we choose a random address for the user when no name is set                   ////
		////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////
		else{
			$query_link = "SELECT new_link FROM url_shortner WHERE new_link = $new_link";
		
			while(mysqli_query($con, $query_link)){
				$new_link = randomString();
			}
		}
		
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////// We end the logic here
		////////////////////////////////////////////////////////////////////////////////////////////////////////

		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//        We insert the value of the short link and the original link into the datatbase     ////
		////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////
		if($err == ''){
			$sql = "INSERT into url_shortner SET
				original_link = '$short_value',
				new_link      = '$new_link',
				created_at      = now(),
				updated_at      = now()";
				
			if(mysqli_query($con, $sql) or mysqli_error($con)){
				$success = 'Link Shorten Successfully';
				$new_link_gen = $new_link;
			}
		}
		
		
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////// We end the logic here
		////////////////////////////////////////////////////////////////////////////////////////////////////////

		
	}
	else{
		$err = 'You Have input No URL';
	}
}

?>
<html lang="en-US">
    <head>
        <title> Shortener URL </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style type="text/css">
        
        body {
            font-family: Helvetica,Arial,sans-serif;
            background: url(<?php echo 'bg.jpg';?>) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
        }
        a{
             font-family: cursive,Helvetica,Arial,sans-serif;
             color: #fff;
             font-size: 30px;
             font-weight: bold;
        }
        .head{
            background-color: #fff;
            border-bottom: solid 1px #333;
            padding: 5px;
            font-size: 14px;
            color: #333;
            font-weight: bold;
            font-family: monospace;
            height: auto;
            text-transform: capitalize;
        }
        
    </style>
    </head>
    <body style="background-color: #eeeeee">
        
		<div class="right_dashboard">

			<form action="" method="post">
				<center>
					<div style="margin-top: 10%;">
					
					<span style="color: #ffffff; font-size: 20px;"><?php echo $success; ?></span><br/>
					<span style="color: #ffffff;"><?php if ( $new_link_gen != ''){ echo "<a href='http://localhost/url_shortner/$new_link_gen' target='_blank'> localhost.com/$new_link_gen </a>"; } ?></span><br/><br/>
						<input style="padding: 10px; width: 500px; height: 50px; border: 1px solid #333;" type="text" name="shortner" placeholder="Enter The URL you want to Short" />
						<input style="padding: 10px; width: 200px; height: 50px; border: 1px solid #333;" type="text" name="choose_addr" placeholder=" (optional) Specify URL name" /> <br/>
						<input style="padding: 10px; font-size: 18px; height: 50px; border: 1px solid #333; width: 200px; margin-top: 10px;" type="submit" value="Shorten" name="submit" />
						<br/><br/><span style="color: #ffffff; text-transform: titlecase; font-size: 25px;"><?php echo $err; ?></span><br/>
					</div>
				</center>
			</form>
			
		</div>
	</body>
</html>