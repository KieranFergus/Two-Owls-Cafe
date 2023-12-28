<!DOCTYPE html>
<html>
    <head>
        <title> Receipt </title>
        <style>
        * {
            font-family: Garamond;
        }
        body {
            text-align: center;
            font-size: 30px;
            width: 100vw;
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
        
        </style>
    </head>
    <body>
        

        <header> <a id='addy' href='#'> <img id='logo' src='https://kieranf.sgedu.site/TwoOwls/images/ovo.jpg' > </a>
         <h1>Two Owls Café</h1>
        </header>
        <script>
            let ddd = Math.floor((Math.random() * 1000) + 99000);
            link = 'https://kieranf.sgedu.site/TwoOwls/menu.php?=' + ddd;
            document.getElementById('addy').setAttribute('href', link);
        </script>
        
    <div id='main2'>
        <br><br><hr>
        <?php
        $queryVal = rand(1000, 100000);
        $loc = 'https://kieranf.sgedu.site/TwoOwls/menu.php?='.$queryVal;

        function currencify($x){
            $y = $x;
            if(strlen($y) >= 3) {
                if($y[strlen($y)-2] == "."){
                    $y .= '0';
                }
            }

            if(!decimalPresent($y)){
                $y .= '.00';
            }

            

            return $y;
        }

        function decimalPresent($z){
            for($c=0;$c<strlen($z);$c++){
                if($z[$c]=="."){
                    return true;
                }
            }
            return false;
        }

        


        if (empty($_POST['firstName']) && empty($_POST['lastName'])) {
            echo "<script>alert('please enter your first and last name')</script>";
            echo "<script>window.location.href='$loc'</script>";
        }
        if (empty($_POST['firstName'])) {
            echo "<script>alert('please enter your first name')</script>";
            echo "<script>window.location.href='$loc'</script>";
        }
        if (empty($_POST['lastName'])) {
            echo "<script>alert('please enter your last name')</script>";
            echo "<script>window.location.href='$loc'</script>";
        }

        $fn = $_POST['firstName'];
        $ln = $_POST['lastName'];

        
        $names = $_POST['varname'];
        $names2 = explode(",",$names);
        unset($names2[8]);

        
        echo $fn." ".$ln."'s Receipt: <br><br><br>";

        $ordered = 0;
        foreach ($names2 as $value) {
            if ($_POST[$value][0] != "0") {
                $ordered++;
            }
        }
        if ($ordered == 0){
            echo "<script>alert('please order an item')</script>";
            echo "<script>window.location.href='$loc'</script>";
        }

        $total = 0;
        foreach ($names2 as $value){
            if ($_POST[$value][0] != "0"){
                $str = $_POST[$value];
                $infoArr = explode(" ",$str);
                $count = floatval($infoArr[0]);
                $thing = $infoArr[1];
                $amt = floatval($infoArr[2]);
                $total += $amt; 
                $fTotal = $total * 1.0625;
                $trueTotal = round($fTotal, 2, PHP_ROUND_HALF_UP);

                $filler = " order of the ";
                if ($count > 1){
                    $filler = " orders of the ";
                }
                echo $count.$filler.$thing.": $".currencify(strval($amt))."<br>";
            }
        }
        $notes = $_POST['instructions'];
        if ($notes != ''){
            echo"<br><br>Special Instructions: ".$notes."<br><br>";
        }
        

        $finalTotal = currencify(strval($total));
        $taxTotal = currencify(strval($trueTotal));
        echo "<br> Subotal: $".$finalTotal."<br>Tax: 6.25%<br> Total: $".$taxTotal;

        
        date_default_timezone_set($_POST['timezone']);
        $orderTime = date('g:ia', time() - (5 * 60 * 60));
        $pickupTime = date('g:ia', time() - (5 * 60 * 60) + 20 * 60);
        
        echo "<br><br> Order time: ".$orderTime."<br> Pickup time: ".$pickupTime."<br><br>";
        ?>
    </div>
    <body>
</html>
