<?php
 $key = 'acb17762511c022129266c8e6c02e682';
 $secret = 'c0319893a63157ba';

$google_key = 'AIzaSyAufkUbXACLy38xcp4iSC7fDvmsps8-IkI';
$base_url = '';
include_once 'assets/header.php';
include_once 'lib/Controller/app_controller.php';

?>

  <script type="text/javascript">
    $(function() {
        $('#stage .lightbox').lightBox();
    });
    </script>
<body>
<!--This is the START of the header-->
<div id="topcontrol" style="position: fixed; bottom: 5px; left: 960px; opacity: 1; cursor: pointer;" title="Go to Top"></div>
<div id="header-wrapper">
  <div id="header">
   
    <div id="header-text">
      <h4>Search your faverite Images!</h4>
      <h6></h6>
    </div>
  </div>
</div>
<!--END of header-->
<!--This is the START of the menu-->
<div id="menu-wrapper">
  <div id="main-menu">
    <ul>
      <li><a href="index.php" class="selected" >Search </a></li>
       <li><a href="index.php">My favourite →</a></li>   
    </ul>
  </div>
	<!--This is the START of the footer-->
	<div id="footer">
		
		<h6>Copyright © 2011 - </h6>
	</div>
	<!--END of footer-->
</div>
<!--END of menu-->
<!--This is the START of the content-->
<div id="content">

	<form action="" method="get" id="gf">
	<p>
		<input type="radio" name="search" value="g" <?php if(isset($_REQUEST['search']) && $_REQUEST['search']=='g' ){?> checked<?php }?>>Google 
		<input type="radio" name="search" value="f" <?php if(isset($_REQUEST['search']) && $_REQUEST['search']=='f' ){?> checked<?php }?>> Flicker 
        <input name="name" id="keyword" type="text" class="input" id="sender_name" value="<?php echo (isset($_REQUEST['name']))? $_REQUEST['name']:''?>" />
        <input type="button" class="button btncolor" name="cmd_search" id="cmd_search"  onClick="" value="Search" />
   	</p>
    </form>    

  <!--This is the START of the portfolio section-->
  <div class="spacer"></div>


  <div id="container"> 
  	
  	
  	<div id="blog">
  	 	<?php
			$src = str_replace('"', '', html_entity_decode($item['resource']));
			$src = html_entity_decode($src);
			
  	 	?>
  	 	
  	 	<div class="blog-item"> <a href="#">
  	 	
  	 	<img  src="<?php echo $src;?>" width="280" height="180" alt="blog1" /></a>
      <div class="blog-item-info">
      
      </div>
      <div class="blog-item-content"> <a href="blog-single.html">
        
        </a>
        <p><?php echo $item['comment'] ?></p>
       <br />
      </div>
    </div>
  	 
  	
  
  </div>
  <!--END of portfolio section-->
</div>
<!--END of content-->


</body>
</html>
