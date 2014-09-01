$('button#start').on('click', function(){
	$.get('db/start.php', function(data){alert(data);
	});
});

$('button#stop').on('click', function(){
	$.get('db/stop.php', function(data){alert(data);
	});
});