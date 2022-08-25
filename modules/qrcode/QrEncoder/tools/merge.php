<?php

 
    $QR_BASEDIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;
    $QR_TOOLSDIR = dirname(__FILE__).DIRECTORY_SEPARATOR;
    
    $outputFile = $QR_BASEDIR.'phpqrcode.php';
    
    // Required libs
    
    $fileList = array(
        $QR_BASEDIR.'qrconst.php',
        $QR_TOOLSDIR.'merged_config.php',
        $QR_BASEDIR.'qrtools.php',
        $QR_BASEDIR.'qrspec.php',
        $QR_BASEDIR.'qrimage.php',
        $QR_BASEDIR.'qrinput.php',
        $QR_BASEDIR.'qrbitstream.php',
        $QR_BASEDIR.'qrsplit.php',
        $QR_BASEDIR.'qrrscode.php',
        $QR_BASEDIR.'qrmask.php',
        $QR_BASEDIR.'qrencode.php'
    );
    
    $headerFile = $QR_TOOLSDIR.'merged_header.php';
    $versionFile = $QR_BASEDIR.'VERSION';
    
    $outputCode = '';
    
    foreach($fileList as $fileName) {
        $outputCode .= "\n\n".'//---- '.basename($fileName).' -----------------------------'."\n\n";
        $anotherCode = file_get_contents($fileName);
        $anotherCode = preg_replace ('/^<\?php/', '', $anotherCode);
        $anotherCode = preg_replace ('/\?>\*$/', '', $anotherCode);
        $outputCode .= "\n\n".$anotherCode."\n\n";
    }
    
	$versionDataEx = explode("\n", file_get_contents($versionFile));
	
    $outputContents = file_get_contents($headerFile);
    $outputContents .= "\n\n/*\n * Version: ".trim($versionDataEx[0])."\n * Build: ".trim($versionDataEx[1])."\n */\n\n";
    $outputContents .= $outputCode;
    
    file_put_contents($outputFile, $outputContents);
    
    