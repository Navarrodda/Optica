<script type="text/javascript"> 
<!-- hide 
function deserrs()
{ 
return true; 
} 
window.onerror = deserrs; 
// --> 
</script>
</head>
<body>
<script type="text/javascript">
var currentpos,timer; 
function initialize() 
{ 
timer=setInterval("scrollwindow()",10);
} 
function sc(){
clearInterval(timer); 
}
function scrollwindow() 
{ 
currentpos=document.body.scrollTop; 
window.scroll(0,++currentpos); 
if (currentpos != document.body.scrollTop) 
sc();
} 
document.onmousedown = sc;
document.ondblclick = initialize;
var tmp = "<div style=\"position:absolute; top:" + parent.offsetY + "; left:" + parent.offsetX + ";height:1181px; width:717px\">";
document.writeln(tmp);
</script>
<table border="0" height="1181" width="717">
<tr><td>
<div style="position:absolute; top:0; left:0;"><img height="1181" width="717"src="bgimg/bg00001.jpg"/></div>
<div style="position:absolute;top:45.300;left:436.152;"><nobr>
<span style="font-size:10.551;color: #0000ff;">PAEZ</span>
<span style="font-size:10.551;color: #0000ff;">ROBERTO</span>
</nobr></div>
</td></tr>
</table>
</div>
<script type="text/javascript">
var currentZoom = parent.toolbarWin.currentZoom;
if(currentZoom != undefined)
document.body.style.zoom=currentZoom/100;
</script>