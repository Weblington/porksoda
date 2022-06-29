<html>
    <head>
        <title>
            Weather 
        </title>
    </head>
<body id = "background">

<link rel="stylesheet" href="main.css">
<style>
    
#rcorners {
  background-color: #5C7F95;
  border-radius: 25px;
  border: 8px solid #315165;
  padding: 20px;
  width: 320px;
  margin: auto;
  text-align: center;
  
}


</style>
<div id = "rcorners">
<form action="daily.php" method="post">
 <p style = "font-family: Gill Sans, sans-serif; font-size: 26px"><b>Your Latitude:</b> <input type="text" name="lat" /></p>
 <p style = "font-family: Gill Sans, sans-serif; font-size: 26px"><b>Your Longitude:</b> <input type="text" name="lon" /></p>

 <input type="radio" id="imperial" name="unit" value="Imperial">

  <label style = "font-family: Gill Sans, sans-serif; font-size: 26px" for="imperial"><b>Imperial</b></label><br> 

<input type="radio" id="metric" name="unit" value="Metric">

  <label style = "font-family: Gill Sans, sans-serif; font-size: 26px" for="metric"><b>Metric</b></label><br>

  <hr style = "opacity: 0">

<p><input type="submit" value="Submit" style="height:50px; width:120px"/></p>
 

</form>

</div>


</body>
</html>