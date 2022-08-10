<?php

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];

        $sToken = "qUsDQvi4h7SrTPkh5AVcfXUw6QIFgTPSHEWPxibVSyN";
        $sMessage = "PSU sport complex : \n";
        $sMessage .= "" .$email ."\n";
        $sMessage .= "เรียนคุณ : " .$fullname ."\n";
        $sMessage .= "คุณเป็นกลุ่มเสี่ยงโควิดเนื่องจากมีผู้มาใช้บริการ ติดโควิดหากคุณมาใช้ในวันที่ดังกล่าว กรุณาได้โปรดติดต่อเจ้าหน้าที่หรือหน่วยงานที่เกี่ยวข้อง \n";

        
        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 

        //Result error 
        if(curl_error($chOne)) 
        { 
            echo 'error:' . curl_error($chOne); 
        } 
        else { 
            $result_ = json_decode($result, true); 
            echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        } 
        curl_close( $chOne );
    }

?>