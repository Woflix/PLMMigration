<!-- START INTERMEDIARYBLURLISTENER.PHP -->
<script type="text/javascript">
	// Listen & Act on Events on Contenteditable <td>'s \\
	$(function(){
		$('td[contenteditable=true]').blur(function(){
			var field_userid = $(this).attr("id");
			var value = $(this).text();
			$.post('../imports/ajaxMigration.php', field_userid + "=" + value, function(data){
				if(data != ''){
					$('.statusUpdated').removeClass("statusUpdatedShow");
					setTimeout (function(){
						$('.statusPushed').addClass("statusPushedShow");
					}, 300);
					setTimeout (function(){
						$('.statusPushed').removeClass("statusPushedShow");
					}, 1300);
				}
			});
		});
	});
</script>
<!-- END INTERMEDIARYBLURLISTENER.PHP -->