<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />

    <!-- Bootstrap JavaScript plugins-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

   <!-- myStyle.css contains the customised styling for this site-->
    <link rel="stylesheet" href="myStyle.css" type="text/css" />

    <title>The Fidgets Shop</title>

  </head>

  <body>
    <!--  Bootstrap navbar with a sticky top. The default background colour is coral. 
      It contains:
      1. a rounded corner logo that has a shadow effect.
      2: a login button that calls a modal login form. The login is hardcoded: 'user' with password 'pass'.
      3. a 'pick a colour select element' that is populated using a javascript array and loop
      -->
    <nav
      class="navbar navbar-expand-lg navbar-light sticky-top"
      style="background-color: coral"
    >
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"
          ><img id=logo src="images/logo.jpg" 
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         
            
          </ul>
          <!-- select options are populated from an array called 'myArray'. When the colour is changed it calls javascript
          function 'changeNavByColour()' -->
          <label>Pick a colour: &nbsp;</label>
          <select class="form-select" id="selectColour" style="margin-right: 30px; width: auto;" onchange="changeNavBgColour()">
            <script>
              var myArray = ["coral", "silver", "plum", "cyan", "lime", "tan", "pink", "yellow", "blue"];
              for (i = 0; i < myArray.length; i++) {
                document.write(
                  '<option value="' +
                    myArray[i] +
                    '">' +
                    myArray[i] +
                    "</option>"
                );
              }
            </script>
          </select>
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-toggle="modal"
            data-bs-target="#loginModal"
          >
            Log In
          </button>
        </div>
      </div>
    </nav>

    <!-- Bootstrap modal login form. it fades in from the top and contains the logo   
    It calls two javascript functions:
    1. validateForm() is triggered when the 'Log in' button is clicked. It checks if the login match (user and pass)
    2. clearErrorMsg() is called when 'Reset' or 'Close' is clicked. It clears the form and message.
    If the user logs in successfully then he/she is taken to the shop.php page -->
        <div
      class="modal fade"
      id="loginModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <img src="images/logo.jpg">&nbsp;&nbsp;
            <h3 class="modal-title" id="exampleModalLabel">Log In</h3>

            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <!-- if the validateForm() returns true then the shop.php page is called -->
            <form name="loginForm" action="shop.php" onsubmit="return validateForm()" >
              <div class="mb-3">
                <label for="uname" class="form-label">Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="uname"
                  name="uname"
                  placeholder="Enter username" 
                  required
                />
                
              </div>
              <div class="mb-3">
                <label for="psw" class="form-label">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="psw"
                  name="psw"
                  placeholder="Enter password"
                  required
                />
                
              </div> 
              <!-- if there is an error message it will be displayed in this label in the modal-->
              <div><label id="errorMsg" name="errorMsg"></label></div>        
          </div>
          <div class="modal-footer">
            <!--  -->
            <button
              type="button"
              class="btn btn-secondary"
              onclick="clearErrorMsg()"
            >
              Reset
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              onclick="clearErrorMsg()"
            >
              Close
            </button>
            <button
              type="submit"
              class="btn btn-primary"
              
            >
              Log in
            </button>
          
          </div> 
        </form> 
        </div>
      </div>
    </div>


    <!-- main content of page- holds the slideshow-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <!--slide show-->

          <br /><br />
          <!-- Slideshow container -->
          <div class="slideshow-container" >
            <!-- Full-width images with number and caption text -->
            <div class="mySlides sFade">
              <div class="numbertext">1 / 3</div>
              <img src="images/Carousel/carsouselPic1.jpg" style="width:100%;">
              
              <div class="textSlide">One stop shop for the latest fidget toys! Log in and enjoy!</div>
          
            </div>

            <div class="mySlides sFade">
              <div class="numbertext">2 / 3</div>
              <img src="images/Carousel/carsouselPic2.jpg" style="width:100%">
              <div class="textSlide">Log in and see the lastest fidget toys at great prices!</div>
       
            </div>

            <div class="mySlides sFade">
              <div class="numbertext">3 / 3</div>
              <img src="images/Carousel/carsouselPic3.jpg" style="width:100%">
              <div class="textSlide">Log in to find on trend fidget toys!</div>
        
            </div>  
          </div> 

          <!-- END of slideshow component-->

        </div>
      </div>
    </div>



    <!--page footer -->
    <?php
        include 'footer.php';
    ?>
    <!-- END of page footer -->



    <script>
    //login form validation
      function validateForm() {
        //Access the username and password variable
        var uName = document.forms["loginForm"]["uname"].value;
        var pw = document.forms["loginForm"]["psw"].value;
        //check if match correct details
        if (uName == "user" && pw == "pass"){
          sessionStorage.user = "Mike";
          return true;
        }
        else {

          // use DOM to display an error message in the modal
            document.getElementById('errorMsg').innerHTML = "Incorrect login details! Please try again.";
            return false;
        } 
        
      }




      //start slide show on random slide when site entered/refreshed
      var slideIndex = Math.floor(Math.random() * 3); ;

    //Automatic Slideshow functions showSlides taken from https://www.w3schools.com/ 
    showSlides();

    //takes the randomly set slideIndex from above from https://www.w3schools.com/ 
    function showSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}
      slides[slideIndex-1].style.display = "block";
      
      setTimeout(showSlides, 5000); // Change image every few seconds
    }

  
    //clear any error messages from the modal login and reset the form
    function clearErrorMsg(){
      document.getElementById('errorMsg').innerHTML = "";
        document.forms["loginForm"]["uname"].value = "";
        document.forms["loginForm"]["psw"].value = "";
   
    }
    
    //change the navbar colour depending on the value selected in the selectColour dropdown list
    function changeNavBgColour() {
            var colour = document.getElementById("selectColour").value;
            sessionStorage.navColour = colour;
            document.getElementsByTagName("nav")[0].style.backgroundColor = colour;
    }
    //set some session info nav background colour and the user is set to 'Mike'
    sessionStorage.navColour = document.getElementsByTagName("nav")[0].style.backgroundColor;
    

    </script>

  </body>

</html>
