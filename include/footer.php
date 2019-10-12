 <script>
$(document).ready(function() {
	$.LoadingOverlay("hide");
	$('.showall').click(function () {
		$('.tbl tr').show();
	});
	$('#tgl').click(function () {
		var testcnt = $(this).text();
		//console.log(testcnt);
		//console.log($('.tbl td:contains('+testcnt+')'));
		//console.log($('.tbl td:not(:contains('+testcnt+'))'));
		$('.tbl tr').hide();
		$('.tbl tr th').parent().show();
		$('.tbl td:contains('+testcnt+')').parent().show();
	});
	$('.tgl').click(function () {
		var testcnt = $(this).text();
		//console.log(testcnt);
		//console.log($('.tbl td:contains('+testcnt+')'));
		//console.log($('.tbl td:not(:contains('+testcnt+'))'));
		$('.tbl tr').hide();
		$('.tbl tr th').parent().show();
		$('.tbl td:contains('+testcnt+')').parent().show();
	});
	$('.wordtgl').click(function () {
		var testcnt = $(this).text();
		//console.log(testcnt);
		//console.log($('.tbl td:contains('+testcnt+')'));
		//console.log($('.tbl td:not(:contains('+testcnt+'))'));
		$('.tbl tr').hide();
		$('.tbl tr th').parent().show();
		$('.tbl td:contains('+testcnt+')').parent().show();
	});
	$('td').click(function () {
		//console.log(1,$(this).text());
		var cnt = $(this).text();
		if (cnt!='') {
			$('td').css('color','#00000044');
			$('td:contains('+cnt+')').css('color','#00ff00');
			$('#tgl').text(cnt);
		}
		
	})

	<?php foreach($TESTS as $t) {
		
		?>
		
		var div<?=$t?> = $('<div>').attr('id','call<?=$t?>').addClass('resultdiv');
		var time<?=$t?> = $('<div>').attr('id','timestart<?=$t?>').addClass('timediv');
		$('body').append('<?=$t?>');
		$('body').append(div<?=$t?>);
		$('body').append(time<?=$t?>);
		$('#call<?=$t?>').LoadingOverlay("show");
		$('#call<?=$t?>').attr("loaded",0);
		jQuery.ajaxQueue({
			url: './?query=<?=urlencode($query)?>',
			dataType: "html",
			method : "POST",
			data: {'loadtest':'<?=$t?>'},
			beforeSend: function( data ) {
				$('#timestart<?=$t?>').html($.now());
			}
		}).done(function( data ) {
			//console.log(data);
			var finaltime<?=$t?> = $('#timestart<?=$t?>').text();
						//$('<div>').attr('id','timeend<?=$t?>').addClass('timediv').html($.now());
						$('#call<?=$t?>').LoadingOverlay("hide");
						$('#call<?=$t?>').attr("loaded",1);
						$('#call<?=$t?>').html(data)
						var ms = ($.now()-finaltime<?=$t?>);
						$('#timestart<?=$t?>').append('- '+$.now()+' = '+ms+'ms / '+(ms/1000)+'s');
		})
	/*		$('#call<?=$t?>').load('./?query=<?=urlencode($query)?>',{'loadtest':'<?=$t?>'},function() {
				var finaltime<?=$t?> = $('#timestart<?=$t?>').text();
				//$('<div>').attr('id','timeend<?=$t?>').addClass('timediv').html($.now());
				$('#call<?=$t?>').LoadingOverlay("hide");
				$('#call<?=$t?>').attr("loaded",1);
				var ms = ($.now()-finaltime<?=$t?>);
				$('#timestart<?=$t?>').append('- '+$.now()+' = '+ms+'ms / '+(ms/1000)+'s');
			});*/

	<?php
	} ?>
});
</script>
</html>
</body>