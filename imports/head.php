		<!-- START HEAD.PHP -->
		<script type="text/javascript">
			// Opens Help Overlay \\
			function openHelpOverlay(){
				$('.helpOverlay').addClass('helpOverlayShowDisplay');
				setTimeout (function(){
					$('.helpOverlay').addClass('helpOverlayShow');
				}, 100);	
			}

			// Closes Help Overlay \\
			function closeHelpOverlay(){
				$('.helpOverlay').removeClass('helpOverlayShow');
				setTimeout (function(){
					$('.helpOverlay').removeClass('helpOverlayShowDisplay');
				}, 400);
			}
		</script>
		<!-- END HEAD.PHP -->