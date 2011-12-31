<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplikasi Arus Kas</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/datepicker.css" media="screen, tv, projection" title="Default" />	
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/flexigrid.css" media="screen, tv, projection" title="Default" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/jquery.ui.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/jquery.ui.base.css">
<script type="text/javascript"src="<?php echo base_url() ?>js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/flexigrid.pack.js"></script>		
<script type="text/javascript" src="<?php echo base_url() ?>js/ddaccordion.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.ui.all.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.layout.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/flexigrid.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>form_attribute/view.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>form_attribute/calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/datepicker.js"></script>


<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='<?php echo base_url() ?>images/images-inadmin/plus.gif' class='statusicon' />", "<img src='<?php echo base_url() ?>images/images-inadmin/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<script type="text/javascript" src="<?php echo base_url() ?>js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>css/niceforms-default.css" />
<?if (isset($added_js)){echo $added_js;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_1)){echo $added_js_1;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_2)){echo $added_js_2;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_3)){echo $added_js_3;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_4)){echo $added_js_4;}?> <!-- attach js flexigrid (jika ada) -->
		<?if (isset($added_js_5)){echo $added_js_5;}?> <!-- attach js flexigrid (jika ada) -->
		<?php
			$tambah_aruskas = false;
			$manajemen_pengguna = false;
			$this->load->library('session');
			$kode_role = $this->session->userdata('kode_role');
			if($kode_role == 1 ){	//untuk role admin
				$tambah_aruskas = true;
				$manajemen_pengguna = true;
			}
		?>
</head>
<body>
<div id="main_container">

	<div class="header">
    <div class="logo"><a href="#"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>
    
    <div class="right_header">Welcome <?php echo $this->session->userdata('username'); ?> | <a href="<?php echo base_url() ?>index.php/login/log_out" class="logout">Logout</a></div>
    </div>
    
    <div class="main_content">
                    <div class="menu">
                    <ul>
                    </ul>
                    </div> 
                            
    <div class="center_content">  
    <div class="left_content">
    

            <div class="sidebarmenu">
				<a class="menuitem" href="<?php echo base_url() ?>index.php/home">Halaman Utama</a>
                <a class="menuitem submenuheader" href="">Arus Kas</a>
                <div class="submenu">
                    <ul>
                    <?php if($tambah_aruskas) { ?><li><a href="<?php echo base_url() ?>index.php/arus_kas/add">Tambah Transaksi</a></li><?php } ?>
                    <li><a href="<?php echo base_url() ?>index.php/arus_kas">Daftar Transaksi</a></li>
                    </ul>
                </div>
                <a class="menuitem submenuheader" href="" >User Menu</a>
                <div class="submenu">
                    <ul>
                    <?php if($manajemen_pengguna) { ?><li><a href="<?php echo base_url() ?>index.php/manajemen_user">Manajemen User</a></li><?php } ?>
                    <li><a href="<?php echo base_url() ?>index.php/login/log_out">Logout</a></li>
                    </ul>
                </div>                    
            </div>  
    </div>  
    
    <div class="right_content">            
      <?php echo $content;?>
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
    <div class="footer">
    
    	<div class="left_footer">© 2011 Research & Development Team</div>
    	
    </div>

</div>		
</body>
</html>
