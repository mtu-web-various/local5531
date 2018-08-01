  <div class="col-sm-2 sidenav"> 
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>
  <?php
  session_start();
  if(isset($_SESSION['user_session']))
		{ 
			  echo $_SESSION['user_session'];
		}
  ?>
  </p>
</footer>

</body>
</html>