<!-- Bootstrap navbar-->
<!-- this nav bar is included on the shop.php, purchase.php and the orderSummary.php pages
It is set with a sticky top. Javascript is used to set the nav colour using DOM
It has a log out button -->

<nav
      class="navbar navbar-expand-lg navbar-light sticky-top"
      style="background-color: silver"
    >
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"
          ><img id="logo" src="images/logo.jpg" style="height: 50px"
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
        <!-- will hold greeting message for login user -->
        <p id="Greeting"></p>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          </ul>			
        <!-- nav contains a log out button when its clicked it calls the logOut function -->
        <button class="btn btn-secondary" onclick="logOut()">Log out</button>
          
        </div>
      </div>
    </nav>