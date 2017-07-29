<?php

           
    
    function orderDeleveredMailer($to,$from,$order_id,$username,$productname,$quintity){
           
        $subject = " Invoice Copy and Delivery Confirmation for bookmybloom.com Order ".$order_id.".";
        
        $message = '<html><body>';
         
        $message .= '<table width="80%"; rules="all" style="border:1px solid #ccc;" cellpadding="10">';
        $message .= "<tr><td style='border-right: 1px solid #fff; background:#4EAF22' colspan=2></td>
        			 </tr>";
        $message .= "<tr><td style='border-right: 1px solid #fff;'><img src='http://www.bookmybloom.com/public/app/images/logo.png' /style='width:45%;'></td>
        				 <td><b>Order Id. ".$order_id."</b></td>
        			 </tr>";
        $message .= "<tr><td style='background: #f5f5f5;' colspan=2><b>&nbsp;&nbsp;Hi ".$username.",</b><p>&nbsp;&nbsp; We are pleased to inform that the following items in your order ".$order_id." have been delivered. This completes your order. Thank you for shopping!</p></br></br> </td></tr>";
        
        $message .= "<tr><td colspan=2>&nbsp;&nbsp;Seller: WS Retail<hr style='width:60%;margin-top: -10px;' size='2px'><p><span style='margin-left:90px;'>".$productname."</span><span style='margin-left:250px;'>Quantity</span></p><p><span style='margin-left:400px;'>".$quintity."</span></p><p><span style='margin-left:20px;'>We have attached your invoices should you need them in the future.</span></p><p><span style='margin-left:20px;'>Help us improve by sharing your valuable feedback below.</span></p></td></tr>"; 
         
        $message .= "<tr><td colspan=2 style='background: #f5f5f5;'><table style='border: 1px solid black; padding:5px;width:100%;'><tr><td><p>How likely is it that you would recommend BookMyBloom to a friend or colleague?</p><p><span style='margin-left:20px;'>Please rate us on a scale of 0-10:</span></p><p><span style='margin-left:20px;'>0 - Not at all likely</span><span style='margin-left:250px;'>10 - Very likely</span></p><p><span style='margin-left:20px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=1&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;1&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=2&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;2&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=3&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;3&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=4&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;4&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=5&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;5&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=6&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;6&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=7&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;7&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=8&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;8&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=9&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;9&nbsp;</a></span><span style='margin-left:25px;'><a href='http://bookmybloom.com/customer_rating.php/?email=".$to."&rat=10&ordrid=".$order_id."' style='border:1px solid blue;text-decoration: none; padding:3px;'>&nbsp;10&nbsp;</a></span></p><p><span style='margin-left:20px;'>Your response will be recorded and you will be redirected to our feedback form.</span> </p></td></tr></table></td></tr>"; 
        $message .= "<tr><td style='border-right:0px; border-bottom:0px;'><p><b>What Next?</b></p><p><span>Enjoy your shopping! Visit the My Orders page in case you wish to return any items.</span></p></td><td style='border-left:0px; border-bottom:0px;'><p><b>Any Questions?</b></p><p><span>Please reply to this email or get in touch with our 24x7 Customer Care team. </span></p></td></tr>"; 
        
        $message .= "<tr><td colspan=2 style='border-top:0'><hr style='width:80%;margin-top: -10px;' size='2px'></br></br><span style='margin-left:30px;'>24x7 Customer Support  |  Buyer Protection  |  Flexible Payment Options  |  Largest Collection </span></td></tr></table></tr>"; 
         
        $message .= "</table>";
         
        $message .= "</body></html>";    
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        $headers .= "From:" . $from;
        
        $send=mail($to,$subject,$message,$headers);
        if($send){
           return $send; 
        }else{
          return false;  
        } 
 }
    
    
    $order_id="BMB33221xg1584m171";
    $username="Mehta Gorakh";
    $productname="Nokia";
    $quintity='2';     
    $from = "gorakhnath1992@gmail.com";
    $to = "gorakhnath1992@gmail.com";
    $return=orderDeleveredMailer($to,$from,$order_id,$username,$productname,$quintity);
    if($return){
        echo 'success';
    }else {
        echo 'failed';
    }
?>

