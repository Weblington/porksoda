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
  position: fixed;
  bottom: 400;
 right: 750;
  
}

#bottomright {

    background-color: #5C7F95;
  border-radius: 25px;
  border: 8px solid #315165;
  padding: 5px;
  width: 140px;
  position: fixed;
  bottom: 0;
  right: 0;
  text-align: center;

}

</style>
<div id = "rcorners">
<form action="currentform.php" method="post">

 <p><input type="submit" value="Current" style="height:50px; width:200px"/></p>
 
</form>

<form action="hourlyform.php" method="post">

 <p><input type="submit" value="Hourly" style="height:50px; width:200px"/></p>
 
</form>

<form action="dailyform.php" method="post">

 <p><input type="submit" value="Daily" style="height:50px; width:200px"/></p>
 
</form>

</div>

<div id = "bottomright">

<form action="developerpass.php" method="post">

 <p><input type="submit" value="Developer" style="height:50px; width:120px"/></p>
 
</form>

</div>


</body>
</html>