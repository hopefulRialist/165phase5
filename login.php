<?php

?>
<div class="form-popup" id="myForm">
 <form action="/action_page.php" class="form-container">
   <h1>Login</h1>

   <label for="email"><b>Email</b></label>
   <input type="text"  name="email" required>

   <label for="psw"><b>Password</b></label>
   <input type="password" name="psw" required>
   <br>
   <button type="submit" class="btn">Login</button>
   <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
 </form>
</div>
