<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

        
    <style>
        
    
        /* =============================================================
        GENERAL STYLES
        ============================================================ */
        body {
            font-family: 'Open Sans', sans-serif;
            font-size:16px;
            line-height:30px;
        }
        .pad-top-botm {
            padding-bottom:40px;
            padding-top:60px;
        }
        h4 {
            text-transform:uppercase;
        }
        /* =============================================================
        PAGE STYLES
        ============================================================ */
    
        .contact-info span {
            font-size:14px;
            padding:0px 50px 0px 50px;
        }
    
        .contact-info hr {
            margin-top: 0px;
        margin-bottom: 0px;
        }
    
        .client-info {
            font-size:15px;
        }
    
        .ttl-amts {
            text-align:right;
            padding-right:50px;
        }
    </style>
    
</head>
<body>

    <div class="container">
     
        <div class="row pad-top-botm ">
           <div class="col-lg-6 col-md-6 col-sm-6 ">
              <img src="assets/img/logo.jpg" style="padding-bottom:20px;"> 
           </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              
                <strong>Your Exchange Order Request is {{$exchange_status}}</strong>
                <br>
                    <i>Name :</i> {{$userDetails['name']}}
                    <i>Name :</i> {{$userDetails['email']}}
           </div>
       </div>

    </div>
    
</body>
</html>



