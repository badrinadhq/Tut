<!DOCTYPE html>
<html>
<head>
      <title>Movies</title>
</head>
<body>
<center><h1>Rating a movie</h1></center>
</body>
</html>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="starrr.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="starrr.js"></script>

<?php
    
     $conn = mysqli_connect("localhost","root","","tut");
     $result = mysqli_query($conn,"SELECT * FROM movies");
     while ($row = mysqli_fetch_object($result)) {

     	$result_ratings =  mysqli_query($conn, "SELECT * FROM ratings WHERE movie_id = '". $row->id . "'");

        $ratings = 0;
        while ($row_ratings = mysqli_fetch_object($result_ratings))
        {
           $ratings  += $row_ratings->ratings;
        }

        $average_ratings = 0;
        if ($ratings > 0)
        {
        	$average_ratings = $ratings / mysqli_num_rows($result_ratings);
        }
        echo $average_ratings;
?>


    <p>
        <?php
             echo $row->name;
        ?>
    </p>

    <form method="POST" onsubmit="return saveRatings(this);">
    	<input type="hidden" name="movie_id" value="<?php echo $row->id; ?>">

    	<p>
    		<div class="starrr"></div>
    	</p>

    	<input type="submit" >
    </form>
<?php     	
     } 
?>


<div class="ratings"></div>

<script>
	var ratings = 0;
	$(function () {
         $(".starrr").starrr().on("starrr:change", function (event,value) {
         	//alert(value);
         	ratings = value;
         });
     });

	function saveRatings(form) {
		var movie_id = form.movie_id.value;
        
        $.ajax({
        	url: "save-ratings.php",
        	method: "POST",
        	data: {
        		"movie_id": movie_id,
        		"ratings": ratings
        	},
        	success: function (response){
        		alert(response); 
        	}
        });

	    return false;
	}
</script>
 