<?php 

class action
{
	public function writeVhosts($myFileVhost, $urlsource, $linkpj, $weburl){
		$fh = fopen($myFileVhost, 'a');
	    $host = "
		    	\n\n<VirtualHost *:80>
		    	\nDocumentRoot ".$urlsource."
		    	\nServerName ".$weburl."
		    	\n<Directory ".$linkpj.">
		    	\nOrder allow,deny
		    	\nAllow from all
		    	\n</Directory>
		    	\n</VirtualHost>
			";
		fwrite($fh, $host);
		fclose($fh);
	}

	public function writeHosts($myFileHost, $weburl)
	{
	    $fh = fopen($myFileHost, 'a');
	    fwrite($fh, "\n127.0.0.10 ".$weburl);
	    fclose($fh);
	}

	public function makeDir($path)
	{
	     $ret = mkdir($path);
	     return $ret === true || is_dir($path);
	}

	public function success($link_address, $weburl)
	{
		echo "Create VirtualHost Successfully".'<br>'.'URL: '.$weburl."<br>"."You must restart apache xampps to start virtualhost"."<br>";
		echo "<a href='".$link_address."'>".$weburl."</a>";
	}
}