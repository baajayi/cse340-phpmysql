<header class="header"> <img src="/phpmotors/images/site/logo.png" alt="php motors logo">
    <span ><?php if(isset($_SESSION['loggedin'])){
 echo "<a href='/phpmotors/accounts/'>Welcome {$_SESSION['clientData']['clientFirstname']}</a>|<a href='/phpmotors/accounts/?action=Logout'><span>Logout</span></a>";
//  echo "<a href='/phpmotors/accounts/?action=Logout'<span>Logout</span></a>";
} else {
   echo "<a href='/phpmotors/accounts/?action=login'>My Account</a>";
} ?></span>
   </header>