<div id="page-background">
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
			document.write('<img src="inc/mobile-background-image.jpg" width="100%" height="100%" alt="Background Image">');
			break;
		}
		else
		{
			document.write('<img src="inc/background-image.jpg" width="100%" height="100%" alt="Background Image">');
			break;
		}
	}
	
</script>
</div>