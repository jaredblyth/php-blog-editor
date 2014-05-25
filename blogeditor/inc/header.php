<div id="header">
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
			document.write('<p align="center"><img src="inc/mobile-header-image.png"></P><p align="center">PHP Blog Editor v2.0 by <a href="http://jaredblyth.com" target="_blank" >Jared Blyth</a>');
			break;
		}
		else
		{
			document.write('<p align="center"><img src="inc/header-image.png"></P><p align="center">PHP Blog Editor v2.0 by <a href="http://jaredblyth.com" target="_blank" >Jared Blyth</a>');
			break;
		}
	}
	
</script>
</div>