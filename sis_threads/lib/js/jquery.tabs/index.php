
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Content-Style-Type" content="text/css">
        <meta http-equiv="Content-Script-Type" content="text/javascript">

        <title>Tabs - jQuery plugin for accessible, unobtrusive tabs</title>

        <script src="jquery-1.1.3.1.pack.js" type="text/javascript"></script>
        <script src="jquery.history_remote.pack.js" type="text/javascript"></script>
        <script src="jquery.tabs.pack.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $('#container-1').tabs();
            });
        </script>

        <link rel="stylesheet" href="jquery.tabs.css" type="text/css" media="print, projection, screen">

        <style type="text/css" media="screen, projection">

            /* Not required for Tabs, just to make this demo look better... */

            body {
                font-size: 16px; /* @ EOMB */
            }
            * html body {
                font-size: 100%; /* @ IE */
            }
            body * {
                font-size: 87.5%;
                font-family: "Trebuchet MS", Trebuchet, Verdana, Helvetica, Arial, sans-serif;
            }
            body * * {
                font-size: 100%;
            }
            h1 {
                margin: 1em 0 1.5em;
                font-size: 18px;
            }
            h2 {
                margin: 2em 0 1.5em;
                font-size: 16px;
            }
            p {
                margin: 0;
            }
            pre, pre+p, p+p {
                margin: 1em 0 0;
            }
            code {
                font-family: "Courier New", Courier, monospace;
            }
        </style>
    </head>
    <body>
        <h2>Simple Tabs</h2>

        <div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>Aba 1</span></a></li>
                <li><a href="#fragment-2"><span>Aba 2</span></a></li>
                <li><a href="#fragment-3"><span>Aba 3</span></a></li>
            </ul>
            <div id="fragment-1">
            	Conteúdo da primeira Aba	
            </div>
            <div id="fragment-2">
                Conteúdo da segunda Aba	
            </div>
            <div id="fragment-3">
                Conteúdo da Terceira Aba	
            </div>
        </div>