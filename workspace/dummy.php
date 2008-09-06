<html>
<head>

  <title>-=- Source Display -=-</title>

    <!--  sourceTab.php           Display Source Page                       -->
    <!--    Which Presents:       the Source of selected pages...           -->
    <!--    Called from:          sourceSelTab.php                          -->

    <link type="text/css" rel="stylesheet" href="css/javascriptAndMySqlSyntaxHighlighter.css"></link>

    <!-- Set the include path, depending on the operating system platform... -->
    			
	<!--  DOCUMENT_ROOT('osLookup.php') require_once                     -->
	<!--                                                                 -->
	<!-- PHP INCLUDED...                                                 -->
	<!--                                                                 -->
	
	<!-- which calls: "include/debugControl.php" to set PHP debug opts   -->
	<!--         and:     "phpSniff.class.php"                           -->
	<!--                   Which determine WIN VS *NIX Platform...       -->

	<!--                                                                 -->
	<!--                            Then sets appropriate Include_path   -->



 
   
    <!-- Page Load Time: 1189687225.109378 seconds... --> 
 
   
  
<!-- osLookup.php determined:                                      --> 
<!--                                                               --> 
<!-- WebServer is running in a Windows Environment                 --> 
<!--                                                               --> 
<!-- and that the server is running Apache.                        --> 
<!-- The Document Root of this server is: c:\WebServ\www\trunk         --> 
    <!--                                                               --> 
    <!-- $currentIncludePath: .;C:\WebServ\php;C:\WebServ\ph ... nk\playground\javascript; --> 
 
   
  
  <!-- SVN UPSFreight Repository Version...: 87 --> 
 
  <!-- Modification Status...........: Modified --> 
 
  <!-- Previous Commit Date...........: 2007/07/31 15:31:41 --> 
 
  <!-- File Build Date...............: 2007/08/01 22:01:22 --> 
 
  <!-- Revision Range................: 80: --> 
 
  <!-- Source Mixture................: Mixed revision WC --> 
 
  <!-- SVN *URL*.....................: file:///C:/SVNRepository/UPGFMetrics/trunk --> 
 
  <!-- SVN Stats via.................: SubWCRev.exe --> 
 
  <!-- Available here................: http://tortoisesvn.sourceforge.net/ --> 
 
  
      <!-- END oslookup.php -->

 
   
   
   
  

    <!-- Include Meta, CSS, JavaScript and the like...               -->
    
        
    <META HTTP-EQUIV="expires" VALUE="Thu, 16 Mar 2000 11:00:00 GMT">

    <link rel="shortcut icon" href="/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/css/webtdo.css" title="style" />

    <!-- Name:  silvertabs.js from PHYRIX.com                                -->
    <!-- Usage: WebTab Engine  										         -->

 
	 
    <SCRIPT LANGUAGE="JavaScript1.1" SRC="/javascript/webtdotabs.js"></script>




    <style type="text/css">
      body { background-color: white; color: #555555; font-family: Verdana, arial; margin: 20px; font-size: 11px; }
      a { color: green; font-size: 11px; text-decoration: none; }  
      a:hover { color: red }
      a:visited { color: green }
      a.nav:active { color: red; text-decoration: none; font-weight: 600; }
      div.page { position: absolute; overflow: auto; width: 660px; height: 620px }
      div.bullet { display: inline; color: #999999 }
    </style>

        <!--  javascript/thisTab.php                          -->
    <!--                                                        -->
    <!--                                                        -->
    <!-- PHP INCLUDED...                                        -->
    <!--                                                        -->
    <!--    Which Presents:             Webtabs                 -->
    <!--                                                        -->
    <!--                                                        -->

    <!--      Called from: Each page which generates            -->
    <!--                   a Webtab... This script              -->
    <!--                   determines who called it,            -->
    <!--                   then builds the correct tab header.  -->
    <!--                   It also calls the correct CSS file   -->
    <!--                   based on the resolution that the     -->
    <!--                   user has his monitor set too...      -->
    <!--                   The resolution is important because  -->
    <!--                   the Iframe paramaters need to change -->

    <!--                   for each resolution...               -->

     
 

<!-- Run javascript/thisTab.php   --> 
 
 
    

<script language=javascript 1.1>

<!-- hide Script from older browsers...

      function f_start() {
      


         
            // Widget Width:                  Parm 1
            // Widget Height:                 Parm 2
            // Widget Buffer in IFRAME, Left: Parm 3
            // Widget Buffer in IFRAME, Top:  Parm 4
            // Widget Positioning:            Parm 5

            // Frame Heights per Level
            // Level One:   No Frame  (Driver Frames...)
            // Level Two:   10000px;
            // Level Three: 9850px;
            // Level Four:  9700px;
            // Level Five:  9550px;
            // Level Six:   9400px;
            // Level Seven: 9250px;

            // WebTab Width / Height Paramater Settings:
            // First Level Tabs do not have an iframe or colored border.
            // level N, N > 1 :  Level N + 1 : WebTab Width  difference = -  16 px
            //                               : WebTab Heigth difference = - 150 px
        
        self.scrollTo(0,0);
        parent.scrollTo(0,0);
        parent.parent.scrollTo(0,0); // GrandParent
        parent.parent.parent.scrollTo(0,0); // Great GrandParent
        //  Leading href=" / " needed for proper resolution if http error (404, for example) is called
        document.write('<link rel="stylesheet" type="text/css" href="/css/webtabs.css"/>');
        document.write('<style>');
        document.write('.WebTabs-tab, .WebTabs-tab-text-container { '); 
        document.write('background: url(/images/Box1Back.gif); '); 
        document.write('} '); 
        document.write('.WebTabs-internal-page-container {  '); 
        document.write('background-image: url(/images/Box1Back.gif); '); 
        document.write('background-repeat: repeat-x;  '); 
        document.write('background-color: #FFFFFF;'); 
        document.write('}  '); 

        document.write('overflow-y:hidden; ');
        document.write('overflow-x:hidden; ');

        document.write('</style> ');

       if (screen.width <= 640) {

          	// <= 640  ( lowrestabs.css) 

		var Widget = new WebTabs_widget(415, 19800, 2, 2, "absolute")

                document.write('<link rel="stylesheet" type="text/css" href="css/lowrestabs.css" title="style" />'); 

             
        } 


        else if (screen.width <= 800) { 

        		var Widget = new WebTabs_widget(571, 19800, 2, 2, "absolute")


             document.write('<link rel="stylesheet" type="text/css" href="css/medrestabs.css" title="style" />'); 

        }


       else if (screen.width <= 1024) { 


                // <= 1024 ( highrestabs.css) 
		var Widget = new WebTabs_widget(796, 19800, 2, 2, "absolute")

             document.write('<link rel="stylesheet" type="text/css" href="css/highrestabs.css"/>');
        }

        if (screen.width > 1024) { 


                // > 1024  (uberGeekResTabs.css) 

		var Widget = new WebTabs_widget(1000, 29800, 2, 2, "absolute")

           document.write('<link rel="stylesheet" type="text/css" href="css/uberGeekResTabs.css"/>');
        }

        // Write out the current Tab paramater
 
        Widget.add(new WebTabs_tab("<b>Source of: /sourceTab.php</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", "page_1", "images/textIcon.png")) 
 

        //
        //
        // ------------------------------------- TAB FRAMES ABOVE ------------------------------------- //

        document.getElementById("WebTabs_container").innerHTML = Widget
        Widget.f_init_tabs()


      }

		// done hiding from old browsers -->

	</script>
	 
 
<!-- End " javascript/thisTab.php  " --> 

<!-- function "Phyrix()" generated a web tab for... ' /sourceTab.php ' ---> 


   
</head> 
<body onLoad="self.scrollTo(0,0); javascript:bulletStart()">
  

    <div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

    <!-- END PHP Included: include_once('include/upsfreightHead.php'); -->


    <!-- page_0 Webtab will be displayed in the event of an error... -->
    <!-- This page is included in every page which has a Webtab...    -->
    <!-- div id=page_0 is loaded whenever thisSilverTab.php deter-    -->
    <!-- mines that the page which called the script does not have    -->
    <!-- an entry in the $thisTab CASE logic. Without such an         -->
    <!-- entry, thisSilverTab.php cannot determine which tab          -->

    <!-- paramerers to load...                                        -->

    <!-- TAB Wiget Related DIV's... Do not modify -->
    <div id=WebTabs_container></div>

    <div id=page_0 class=WebTabs-external-page-container>
    <div class=WebTabs-internal-page-container>
    <!-- END TAB Wiget Related DIV's...          -->
	
		<br/><!-- This bad boy ensures that the Box Header Background Image extends across the DIV -->
		
		<div style='text-align: justify'>

		
	       &nbsp; <!-- This bad boy ensures that the Box Header Background Image extends across the DIV -->

            <p id='BoxHeaderText'>
            </p>
            <div id='content'> <!-- content DIV -->
	      

            <div class=Indented18></div>
            </p>

            <br />

    	    <p>&nbsp;</p>

    	    </div> <!-- END content DIV -->

        </div> <!-- END style='text-align: justify' -->

    </div> <!-- END id=page_0 class=WebTabs-external-page-container -->
    </div> <!-- END class=WebTabs-internal-page-container -->

    <!-- END "include/page_0.php" member -->



	<!-- Source Display Tab -->

    <!-- TAB Wiget Related DIV's... Do not modify -->
    <div id=WebTabs_container></div>
    <div id=page_1 class=WebTabs-external-page-container>

	<div id="tab" class="autoTab">

    <div class=WebTabs-internal-page-container>
    <!-- END TAB Wiget Related DIV's...          -->

    &nbsp;


<!-- //////// START OF FILE ///////// START OF FILE /////// START OF FILE //////// --> 
Source of: C:/WebServ/www/production/dummy.php  <br /> <br /> 
 <ul> 
<p /> 
<div class="autoTab"> 
<div class="autoTab"><div class="dp-auto-highlighter"> 

<code>
    <span style="color: #FF00FF;">&lt;?php</span><br />
    <span style="color: #9966ff;">@</span><span style="color: #8B4513;">ini_set</span><span style="color: #9966ff;">(</span><span style="color: #2E5EB1;">'zend_monitor.enable'</span><span style="color: #9966ff;">,</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #FF0000;">0</span><span style="color: #9966ff;">)</span><span style="color: #9966ff;">;</span><br />
    <span style="color: #9966ff;">if</span><span style="color: #9966ff;">(</span><span style="color: #9966ff;">@</span><span style="color: #8B4513;"><a class=nav href="http://www.php.net/function.function_exists">function_exists</a></span><span style="color: #9966ff;">(</span><span style="color: #2E5EB1;">'output_cache_disable'</span><span style="color: #9966ff;">)</span><span style="color: #9966ff;">)</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #9966ff;">{</span><br />

    <span style="color: #CCB440;">&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #9966ff;">@</span><span style="color: #8B4513;"><a class=nav href="http://www.php.net/function.output_cache_disable">output_cache_disable</a></span><span style="color: #9966ff;">(</span><span style="color: #9966ff;">)</span><span style="color: #9966ff;">;</span><br />
    <span style="color: #9966ff;">}</span><br />
    <span style="color: #9966ff;">if</span><span style="color: #9966ff;">(</span><span style="color: #4876FF;">isset</span><span style="color: #9966ff;">(</span><span style="color: #019DB2;">$_GET</span><span style="color: #9966ff;">[</span><span style="color: #2E5EB1;">'debugger_connect'</span><span style="color: #9966ff;">]</span><span style="color: #9966ff;">)</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #8D04D8;">&amp;&amp;</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #019DB2;">$_GET</span><span style="color: #9966ff;">[</span><span style="color: #2E5EB1;">'debugger_connect'</span><span style="color: #9966ff;">]</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #8D04D8;">==</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #FF0000;">1</span><span style="color: #9966ff;">)</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #9966ff;">{</span><br />

    <span style="color: #CCB440;">&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #9966ff;">if</span><span style="color: #9966ff;">(</span><span style="color: #8B4513;"><a class=nav href="http://www.php.net/function.function_exists">function_exists</a></span><span style="color: #9966ff;">(</span><span style="color: #2E5EB1;">'debugger_connect'</span><span style="color: #9966ff;">)</span><span style="color: #9966ff;">)</span><span style="color: #CCB440;">&nbsp;&nbsp;</span><span style="color: #9966ff;">{</span><br />
    <span style="color: #CCB440;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #8B4513;"><a class=nav href="http://www.php.net/function.debugger_connect">debugger_connect</a></span><span style="color: #9966ff;">(</span><span style="color: #9966ff;">)</span><span style="color: #9966ff;">;</span><br />
    <span style="color: #CCB440;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF0000;">exit</span><span style="color: #9966ff;">(</span><span style="color: #9966ff;">)</span><span style="color: #9966ff;">;</span><br />

    <span style="color: #CCB440;">&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #9966ff;">}</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #9966ff;">else</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #9966ff;">{</span><br />
    <span style="color: #CCB440;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #FF00FF;">echo</span><span style="color: #CCB440;">&nbsp;</span><span style="color: #2E5EB1;">&quot;No&nbsp;connector&nbsp;is&nbsp;installed.&quot;</span><span style="color: #9966ff;">;</span><br />
    <span style="color: #CCB440;">&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #9966ff;">}</span><br />
    <span style="color: #9966ff;">}</span><br />

    <span style="color: #FF00FF;">?&gt;</span><br />
    &nbsp;<br />
</code>
</div> 
</ul> 
<script language=javascript> 
<font color="violet"> 
if (screen.width <= 640) 
{ 
document.write('<br \>'); 
document.write('&nbsp; /////////////////////////////// END OF FILE ///////////////////////////////'); 
} 
 
else if (screen.width <= 800) 
{ 
document.write('<br \>'); 
document.write('&nbsp; /////////////////////////////////////////////// END OF FILE //////////////////////////////////////////////'); 
} 
 
else if (screen.width <= 1024) 
{ 
document.write('<br \>'); 
document.write('&nbsp; //////////////////////////////////////////////////////////////////// END OF FILE ///////////////////////////////////////////////////////////////////'); 
} 

if (screen.width > 1024) 
{ 
document.write('<br \>'); 
document.write('&nbsp; ////////////////////////////////////////////////////////////////////////////////////////// END OF FILE /////////////////////////////////////////////////////////////////////////////////////////'); 
} 

</script> 
</div> 

   </div> <!-- END content DIV -->
   </div>

   </div>

   </div>

 </body>
</html>



