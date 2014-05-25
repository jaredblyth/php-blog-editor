<link href="inc/style.css" rel="stylesheet" type="text/css">

<script type = "text/javascript">
	var sniffer=new Object();
	var agentNow=navigator.userAgent.toLowerCase();
	sniffer.android=(agentNow.search("android")>=0);
	sniffer.series60=(agentNow.search("series60")>=0);
	sniffer.iphone=(agentNow.search("iphone")>=0);
	sniffer.blackberry=(agentNow.search("blackberry")>=0);
	sniffer.windowsce=(agentNow.search("windows ce")>=0);
	
	for(var mobile in sniffer)
	{
		if(sniffer[mobile])
		{
			document.write('<link rel="stylesheet" type="text/css" href="inc/styleMobile.css">');
			break;
		}
	}
	
</script>