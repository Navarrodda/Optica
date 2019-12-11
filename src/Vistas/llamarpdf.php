<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Tablas</title>
<link type="text/css" rel="stylesheet" href="../fpdf.css">
</head>
<body>
<h1>Tablas</h1>
Este tutorial se explicará como crear tablas fácilmente.
<div class="source">
<pre><code>&lt;?php
<span class="kw">require(</span><span class="str">'fpdf.php'</span><span class="kw">);

class </span>PDF <span class="kw">extends </span>FPDF
<span class="kw">{
</span><span class="cmt">// Cargar los datos
</span><span class="kw">function </span>LoadData<span class="kw">(</span>$file<span class="kw">)
{
    </span><span class="cmt">// Leer las líneas del fichero
    </span>$lines <span class="kw">= </span>file<span class="kw">(</span>$file<span class="kw">);
    </span>$data <span class="kw">= array();
    foreach(</span>$lines <span class="kw">as </span>$line<span class="kw">)
        </span>$data<span class="kw">[] = </span>explode<span class="kw">(</span><span class="str">';'</span><span class="kw">,</span>trim<span class="kw">(</span>$line<span class="kw">));
    return </span>$data<span class="kw">;
}

</span><span class="cmt">// Tabla simple
</span><span class="kw">function </span>BasicTable<span class="kw">(</span>$header<span class="kw">, </span>$data<span class="kw">)
{
    </span><span class="cmt">// Cabecera
    </span><span class="kw">foreach(</span>$header <span class="kw">as </span>$col<span class="kw">)
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>40<span class="kw">,</span>7<span class="kw">,</span>$col<span class="kw">,</span>1<span class="kw">);
    </span>$<span class="kw">this-&gt;</span>Ln<span class="kw">();
    </span><span class="cmt">// Datos
    </span><span class="kw">foreach(</span>$data <span class="kw">as </span>$row<span class="kw">)
    {
        foreach(</span>$row <span class="kw">as </span>$col<span class="kw">)
            </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>40<span class="kw">,</span>6<span class="kw">,</span>$col<span class="kw">,</span>1<span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Ln<span class="kw">();
    }
}

</span><span class="cmt">// Una tabla más completa
</span><span class="kw">function </span>ImprovedTable<span class="kw">(</span>$header<span class="kw">, </span>$data<span class="kw">)
{
    </span><span class="cmt">// Anchuras de las columnas
    </span>$w <span class="kw">= array(</span>40<span class="kw">, </span>35<span class="kw">, </span>45<span class="kw">, </span>40<span class="kw">);
    </span><span class="cmt">// Cabeceras
    </span><span class="kw">for(</span>$i<span class="kw">=</span>0<span class="kw">;</span>$i<span class="kw">&lt;</span>count<span class="kw">(</span>$header<span class="kw">);</span>$i<span class="kw">++)
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>$i<span class="kw">],</span>7<span class="kw">,</span>$header<span class="kw">[</span>$i<span class="kw">],</span>1<span class="kw">,</span>0<span class="kw">,</span><span class="str">'C'</span><span class="kw">);
    </span>$<span class="kw">this-&gt;</span>Ln<span class="kw">();
    </span><span class="cmt">// Datos
    </span><span class="kw">foreach(</span>$data <span class="kw">as </span>$row<span class="kw">)
    {
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>0<span class="kw">],</span>6<span class="kw">,</span>$row<span class="kw">[</span>0<span class="kw">],</span><span class="str">'LR'</span><span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>1<span class="kw">],</span>6<span class="kw">,</span>$row<span class="kw">[</span>1<span class="kw">],</span><span class="str">'LR'</span><span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>2<span class="kw">],</span>6<span class="kw">,</span>number_format<span class="kw">(</span>$row<span class="kw">[</span>2<span class="kw">]),</span><span class="str">'LR'</span><span class="kw">,</span>0<span class="kw">,</span><span class="str">'R'</span><span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>3<span class="kw">],</span>6<span class="kw">,</span>number_format<span class="kw">(</span>$row<span class="kw">[</span>3<span class="kw">]),</span><span class="str">'LR'</span><span class="kw">,</span>0<span class="kw">,</span><span class="str">'R'</span><span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Ln<span class="kw">();
    }
    </span><span class="cmt">// Línea de cierre
    </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>array_sum<span class="kw">(</span>$w<span class="kw">),</span>0<span class="kw">,</span><span class="str">''</span><span class="kw">,</span><span class="str">'T'</span><span class="kw">);
}

</span><span class="cmt">// Tabla coloreada
</span><span class="kw">function </span>FancyTable<span class="kw">(</span>$header<span class="kw">, </span>$data<span class="kw">)
{
    </span><span class="cmt">// Colores, ancho de línea y fuente en negrita
    </span>$<span class="kw">this-&gt;</span>SetFillColor<span class="kw">(</span>255<span class="kw">,</span>0<span class="kw">,</span>0<span class="kw">);
    </span>$<span class="kw">this-&gt;</span>SetTextColor<span class="kw">(</span>255<span class="kw">);
    </span>$<span class="kw">this-&gt;</span>SetDrawColor<span class="kw">(</span>128<span class="kw">,</span>0<span class="kw">,</span>0<span class="kw">);
    </span>$<span class="kw">this-&gt;</span>SetLineWidth<span class="kw">(</span>.3<span class="kw">);
    </span>$<span class="kw">this-&gt;</span>SetFont<span class="kw">(</span><span class="str">''</span><span class="kw">,</span><span class="str">'B'</span><span class="kw">);
    </span><span class="cmt">// Cabecera
    </span>$w <span class="kw">= array(</span>40<span class="kw">, </span>35<span class="kw">, </span>45<span class="kw">, </span>40<span class="kw">);
    for(</span>$i<span class="kw">=</span>0<span class="kw">;</span>$i<span class="kw">&lt;</span>count<span class="kw">(</span>$header<span class="kw">);</span>$i<span class="kw">++)
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>$i<span class="kw">],</span>7<span class="kw">,</span>$header<span class="kw">[</span>$i<span class="kw">],</span>1<span class="kw">,</span>0<span class="kw">,</span><span class="str">'C'</span><span class="kw">,</span>true<span class="kw">);
    </span>$<span class="kw">this-&gt;</span>Ln<span class="kw">();
    </span><span class="cmt">// Restauración de colores y fuentes
    </span>$<span class="kw">this-&gt;</span>SetFillColor<span class="kw">(</span>224<span class="kw">,</span>235<span class="kw">,</span>255<span class="kw">);
    </span>$<span class="kw">this-&gt;</span>SetTextColor<span class="kw">(</span>0<span class="kw">);
    </span>$<span class="kw">this-&gt;</span>SetFont<span class="kw">(</span><span class="str">''</span><span class="kw">);
    </span><span class="cmt">// Datos
    </span>$fill <span class="kw">= </span>false<span class="kw">;
    foreach(</span>$data <span class="kw">as </span>$row<span class="kw">)
    {
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>0<span class="kw">],</span>6<span class="kw">,</span>$row<span class="kw">[</span>0<span class="kw">],</span><span class="str">'LR'</span><span class="kw">,</span>0<span class="kw">,</span><span class="str">'L'</span><span class="kw">,</span>$fill<span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>1<span class="kw">],</span>6<span class="kw">,</span>$row<span class="kw">[</span>1<span class="kw">],</span><span class="str">'LR'</span><span class="kw">,</span>0<span class="kw">,</span><span class="str">'L'</span><span class="kw">,</span>$fill<span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>2<span class="kw">],</span>6<span class="kw">,</span>number_format<span class="kw">(</span>$row<span class="kw">[</span>2<span class="kw">]),</span><span class="str">'LR'</span><span class="kw">,</span>0<span class="kw">,</span><span class="str">'R'</span><span class="kw">,</span>$fill<span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>$w<span class="kw">[</span>3<span class="kw">],</span>6<span class="kw">,</span>number_format<span class="kw">(</span>$row<span class="kw">[</span>3<span class="kw">]),</span><span class="str">'LR'</span><span class="kw">,</span>0<span class="kw">,</span><span class="str">'R'</span><span class="kw">,</span>$fill<span class="kw">);
        </span>$<span class="kw">this-&gt;</span>Ln<span class="kw">();
        </span>$fill <span class="kw">= !</span>$fill<span class="kw">;
    }
    </span><span class="cmt">// Línea de cierre
    </span>$<span class="kw">this-&gt;</span>Cell<span class="kw">(</span>array_sum<span class="kw">(</span>$w<span class="kw">),</span>0<span class="kw">,</span><span class="str">''</span><span class="kw">,</span><span class="str">'T'</span><span class="kw">);
}
}

</span>$pdf <span class="kw">= new </span>PDF<span class="kw">();
</span><span class="cmt">// Títulos de las columnas
</span>$header <span class="kw">= array(</span><span class="str">'País'</span><span class="kw">, </span><span class="str">'Capital'</span><span class="kw">, </span><span class="str">'Superficie (km2)'</span><span class="kw">, </span><span class="str">'Pobl. (en miles)'</span><span class="kw">);
</span><span class="cmt">// Carga de datos
</span>$data <span class="kw">= </span>$pdf<span class="kw">-&gt;</span>LoadData<span class="kw">(</span><span class="str">'paises.txt'</span><span class="kw">);
</span>$pdf<span class="kw">-&gt;</span>SetFont<span class="kw">(</span><span class="str">'Arial'</span><span class="kw">,</span><span class="str">''</span><span class="kw">,</span>14<span class="kw">);
</span>$pdf<span class="kw">-&gt;</span>AddPage<span class="kw">();
</span>$pdf<span class="kw">-&gt;</span>BasicTable<span class="kw">(</span>$header<span class="kw">,</span>$data<span class="kw">);
</span>$pdf<span class="kw">-&gt;</span>AddPage<span class="kw">();
</span>$pdf<span class="kw">-&gt;</span>ImprovedTable<span class="kw">(</span>$header<span class="kw">,</span>$data<span class="kw">);
</span>$pdf<span class="kw">-&gt;</span>AddPage<span class="kw">();
</span>$pdf<span class="kw">-&gt;</span>FancyTable<span class="kw">(</span>$header<span class="kw">,</span>$data<span class="kw">);
</span>$pdf<span class="kw">-&gt;</span>Output<span class="kw">();
</span>?&gt;</code></pre>
</div>
<p class='demo'><a href='/pdf/pdfvista' target='_blank' class='demo'>[Demo]</a></p>
Siendo una tabla un conjunto de celdas, lo natural es construirla de ellas. El
primer ejemplo es el más básico posible: celdas con bordes simples, todas del mismo
tamaño y alineadas a la izquierda. El resultado es algo rudimentario, pero es
muy rápido de conseguir.
<br>
<br>
La segunda tabla tiene algunas mejoras: cada columna tiene su propio ancho, los títulos
están centrados y el texto se alinea a la derecha. Más aún, las líneas horizontales se
han eliminado. Esto se consigue mediante el parámetro <code>border</code>
del método <a href='../doc/cell.htm'>Cell()</a>, que especifica qué bordes de la celda deben imprimirse.
En este caso, queremos que sean los de la izquierda (<code>L</code>) y los de la derecha
(<code>R</code>). Seguimos teniendo el problema de la línea horizontal de fin de tabla.
Hay dos posibilidades: o comprobar si estamos en la última línea en el bucle, en cuyo caso
usaremos <code>LRB</code> para el parámtro <code>border</code>; o, como hemos hecho aquí,
añadir la línea una vez que el bucle ha terminado.
<br>
<br>
La tercera tabla es similar a la segunda, salvo por el uso de colores. Simplemente hemos
especificado los colores de relleno, texto y línea. El coloreado alternativo de las filas
se consigue alternando celdas transparentes y coloreadas.
</body>
</html>
