
$(document).ready(function () {
    $('.openlogin').click(function () {
        $('#signid').slideUp("1s");
        $('#forgid').slideUp("1s");
        $('#loginid').slideDown("1s");
    });
    $('.openregister').click(function () {
        $('#signid').slideDown("1s");
        $('#forgid').slideUp("1s");
        $('#loginid').slideUp("1s");
    });
    $('.openforgpass').click(function () {
        $('#signid').slideUp("1s");
        $('#loginid').slideUp("1s");
        $('#forgid').slideDown("1s");
    });
});


$(document).ready(function(){
       $("#registerform").validate({
           rules:{
               username:"required",
               useremail:{
                   required:false,
                   email:true,
               },
               userphone:{
                   required:true,
                   number: true,
                   maxlength:12,
               },
             userpassword:{
                 required:true,
                 minlength:5,
                 maxlength:18,
               }
           },
           messages:{
               username:"<b style='color:red'>Please Enter Full Name.</b>",
               useremail:"<b style='color:red'>Please Enter Valide Email.</b>",
               userphone:"<b style='color:red'>Please Enter Valide Phone No.</b>",
               userpassword:"<b style='color:red'>Please Enter Password.</b>"
           }
       });
    });


$(document).ready(function(){
    $("#loginform").validate({
        rules:{
                password:true,
               emailorphone:{
                   required:true,
                },

           },
           messages:{
               password:"<b style='color:red'>Please Enter Password.</b>",
               emailorphone:"<b style='color:red'>Please Enter Email or phone.</b>"
               
           }
    });
});

$(document).ready(function(){
    $("#loginform").validate({
        rules:{
                password:true,
               emailorphone:{
                   required:true,
                },

           },
           messages:{
               password:"<b style='color:red'>Please Enter Password.</b>",
               emailorphone:"<b style='color:red'>Please Enter Email or phone.</b>"
               
           }
    });
});


$(document).ready(function(){
    $("#forgotpass").validate({
        rules:{
            emailorphone:{
                   required:true,
                },
        },
        messages:{
            emailorphone:"<b style='color:red'>Please Enter Email or phone.</b>"
        }
    });
});

/* Leader Login and Registration page validation */

$(document).ready(function(){
    $("#leaderloginform").validate({
        rules:{
            email:{
             required:true,
             email:true,
            },
         password:{
             required:true,
         }    
        },
        messages:{
            email:"<span style='color:red'>Please Enter Email address.</span>",
            password:"<span style='color:red'>Please Enter password.</span>"
        }
    });
});

$(document).ready(function(){
   $("#leaderforgotform").validate({
       rules:{
           email:{
               required:true,
               email:true,
           }
       },
       messages:{
           email:"<span style='color:red'>Please Enter Email address.</span>",
       }
   });
});

$(document).ready(function(){
    $("#leaderregisterform").validate({
        rules: {
        name:"required",
        email:{
            required:true,
            email:true,
        },
        phone:{
            required:true,
            number:true,
            maxlength:12,
            minlength:10,
        },
        pass:{
            required:true,
            minlength:5,
            maxlength:18,
        },
        cnfmpassword:{
            required:true,
            minlength:5,
            maxlength:18,
            equalTo:"#pass",
        },
        level:{
            required:true,
          }
    }
    ,messages:{
        name:"<span style='color:red'> Please Enter Name.</span>",
        email:"<span style='color:red'> Please Enter Email.</span>",
        phone:"<span style='color:red'> Please Enter Phone No.</span>",
        pass:"<span style='color:red'> Please Enter Password.</span>",
        cnfmpassword:"<span style='color:red'>Confirm Password should be Same.</span>",
        level:"<span style='color:red'>Please Select Party Level.</span>"
    }
    });
});