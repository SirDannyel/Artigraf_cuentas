 
        function UserValidation(){
             let us = '';
               us = localStorage.getItem('user');   
             //  console.log(us);

               if(us === null || us ==='null'){
                    location.href ="http://localhost/Projects/Artigraf/login.php"; 
               }

        } 