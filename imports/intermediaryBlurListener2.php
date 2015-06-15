<!-- START INTERMEDIARYBLURLISTENER.PHP -->
<script type="text/javascript">
	// Listen & Act on Events on Contenteditable <td>'s \\
	$(function(){
		$('td[contenteditable=true]').blur(function(){
		//$('td[contenteditable=true]').dbclick(function(){
			var field_userid = $(this).attr("id");
			//var value = $(this).text();
			var value = "Complete";
			$.post('../imports/ajaxEnditem.php', field_userid + "=" + value, function(data){
				if(data != ''){
					$('.statusUpdated').removeClass("statusUpdatedShow");
					setTimeout (function(){
						$('.statusPushed').addClass("statusPushedShow");
					}, 300);
					setTimeout (function(){
						$('.statusPushed').removeClass("statusPushedShow");
					}, 1700);
				}
			});
		});
	});
</script>
<!--<?php //echo $_GET["user"]; ?>-->
<!-- END INTERMEDIARYBLURLISTENER.PHP -->