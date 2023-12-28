<!DOCTYPE html>
<html>
    <head>
        <title>Two Owls Menu</title>
        <style>
            * {
                font-family: Garamond;
            }
            body {
                text-align: center;
                width: 100vw;
                font-size: 25px;
            }
            
            header {
                width:100vw;
                height:10vh;
            }
            h1 {
                margin: auto 0;
                font-size: 30px;
            }
            #logo {
                max-height:100px;
                height: 17vh;
                margin-left: 0;
            }
            #conf {
                width: 170px;
                border: 1px solid;
                border-radius: 5px;
                padding: 10px;
                background-color: #fff;
                style: none;
                font-size: 25px;
                transition: 0.2s ease;
            }
            #conf:hover {
                transform: scale(1.05,1.05);
                color: #fff;
                background-color: #444;
            }
            label {
                padding: 5px;
                
            }
            select {
                border-radius: 5px;
                padding: 5px;
                font-size: 25px;
            }
            .entry {
                padding: 5px;
                font-size: 25px;
                margin-bottom: 7px;
            }
            #order {
                width: 95vw;
            }
            

        </style>

    </head>

    <body>
        <header> <img id='logo' src='https://kieranf.sgedu.site/TwoOwls/images/ovo.jpg'> 
        <h1>Two Owls Café</h1>
        </header>
    
    <div id='main2'>
        <br><br><hr>
        <?php
            
            $server = "localhost";
            $userid = "uyhes3uzrcret";
            $pw = "Basedgod2012";
            $db = "dbiftl1a9zgpbt";

            $conn = new mysqli($server, $userid, $pw);

            if ($conn->connect_error) {
                die("connection failed: ".$conn->connect_error);
            }
            //echo "connected successfully! <br><br>";

            $conn->select_db($db);

            $sql = "SELECT * FROM menu";
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                echo "<form id='order' name='order' action='process.php' onsubmit='validate()' 
                method='post'>";
                $all = '';
                while($row = $result->fetch_assoc())
                {
                    echo "<strong>".$row["name"].": </strong>".
                    " $".$row["price"].
                    " <br>".$row["description"]."<br>";
                    $source = "https://kieranf.sgedu.site/TwoOwls/images/".$row["image"];
                    echo "<img src='$source' /><br>";
                    $item = $row["name"];
                    $all .= $item.",";
                    $price = $row["price"];
                    echo "<label for='quant'>Quantity:</label>
                    <select name='$item' form='order'>";
                    for($i=0; $i<11; $i++){
                        $infoString = $i." ".$item." ".($i*$price);
                        echo "<option value='$infoString'>$i</option>";
                        
                    }
                    echo "</select> <br><br><hr><br>";
                }
                echo "<input type='hidden' name='varname' value='$all'>";
                echo "<script>tz = Intl.DateTimeFormat().resolvedOptions().timeZone;</script>";
                echo "<input type='hidden' name='timezone' value='tz'>";
                echo "<label for='firstName'>First Name: </label>
                    <input class='entry' type='text' name='firstName' value='' form='order'>
                    <br>
                    <label for='lastName'>Last Name: </label>
                    <input class='entry' type='text' name='lastName' value='' form='order'>
                    <br>
                    <label for='instructions'>Special Instructions:<br> </label>
                    <textarea class='entry' name='instructions' form ='order'></textarea><br>
                    
                    <input id='conf' type='submit' value='Submit Order' form='order'>
                    </form><br><br><br>";
            }
            else
                echo "no results";

            $conn->close();

        ?>
    </div>
        
        
    </body>
</html>
