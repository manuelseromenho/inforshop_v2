

<!-- ****************** FOOTER *************** -->
	<div class="footer">
		<p class="footer"> Hoje,  
			<script language="JavaScript"> 
				var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
				var day = currentDate.getDate();
				var month = currentDate.getMonth() + 1;
				var year = currentDate.getFullYear();

				var currentTime = new Date()
				var hours = currentTime.getHours()
				var minutes = currentTime.getMinutes()

				if (minutes < 10)
					minutes = "0" + minutes
					document.write("<b>" + day + "-" + month + "-" + year + " " + hours + ":" + minutes + " " +"</b>");
			</script> 
		</p> <!-- data & hora -->
        Powered by <a href="http://www.ualg.pt/home/pt/curso/1684">UAlg - ISE - LTIC 2015</a>

        <p><a href="../logout.php"> Logout </a> </p>
    </div>
