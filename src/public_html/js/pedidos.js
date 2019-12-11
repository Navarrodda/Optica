
/**ENVIANDO EL PEDIDO**/

function pasarRemitoAlArray()
{
	var tabla = document.getElementById("remito");
	var arreglo = [];
	for(var i=1; i<tabla.rows.length;i++){

        var celda_descripcion=(tabla.rows[i].id);

        arreglo[i-1] = celda_descripcion;
     }

     var descripcion = arreglo.join();

     return descripcion;
}

function enviarPedido()
{
	var input_descripcion = document.getElementById("hidden_descripcion");
	var input_importe = document.getElementById("hidden_importe");
	var importe = document.getElementById("importe");

	input_importe.value = importe.innerHTML;
	input_descripcion.value = pasarRemitoAlArray();

	document.forms.modalForm.submit();

}

function abrirModal(){

	removeAllChilds("bodyTableModal",false);
	$("#modalForm").modal();

	tabla_modal = document.getElementById("modalTable").getElementsByTagName('tbody')[0];
	tabla_remito = document.getElementById("remito");
	importe = document.getElementById("importe");
	var total = 0;
	var arreglo = [];

	for(var i=1; i<tabla_remito.rows.length;i++){

		var celda_descripcion=(tabla_remito.rows[i].id);

		var value = celda_descripcion.split('|');
		

		if((value[4].localeCompare("producto")) == 0){
			var calculo = parseInt(value[2]) * parseInt(value[3]);
			var dato = value[3];
		}else{
			var calculo = (parseInt(value[2]) * parseInt(value[3]) * parseInt(value[5]) * parseFloat(value[6])); 
			var dato = value[3] + ' (x ' + value[5] + 'Lts * '+ value[6]+')';
		}
		
		var row = tabla_modal.insertRow(i-1);

		row.insertCell(0);
		row.insertCell(1);
		row.insertCell(2);
		row.insertCell(3);

		tabla_modal.rows[i-1].cells[0].innerHTML = value[0];
		
		tabla_modal.rows[i-1].cells[1].innerHTML = '$' + dato;

		tabla_modal.rows[i-1].cells[2].innerHTML = value[2];
		
		tabla_modal.rows[i-1].cells[3].innerHTML = '$' + calculo;

		total += calculo;
     }

     importe.value = total;
     importe.innerHTML = total;


}

/*********************************/
function removeAllChilds(a,boolean)
{
	var a=document.getElementById(a);
	while(a.hasChildNodes())
		a.removeChild(a.firstChild);

	if(boolean){
	$(a).remove();
	}
}

function verificarDescripcion(desc,btn)
{
	var tabla  = document.getElementById("remito");
	//var producto = traerProductoSeleccionado();
	//var desc = producto.text;
	var flag = false;

	for(var i=1; i<tabla.rows.length;i++){

        var celda_descripcion=(tabla.rows[i].cells[0].innerHTML);

        var str_a_comparar = celda_descripcion.split(' x');

        if((str_a_comparar[0].localeCompare(desc)) == 0)
        	{
        		flag = true;
        		btn.disabled = true;
        		break;
        	}
     }

     return flag;
}

function traerLitrosDeCervezaSeleccionada()
{
	var lista = document.getElementById('litrosC');
	var opcion = lista.selectedIndex;
	var value = lista.options[opcion];
	return value;
}

function agregarC()
{
	var cantidad = traerCantidadDeCervezaSeleccionada();
	if(parseInt(cantidad.value) > 0){
	var litros = traerLitrosDeCervezaSeleccionada();
	document.getElementById("btnModal").disabled=false;
	var tabla  = document.getElementById("remito").getElementsByTagName('tbody')[0];
	var row = tabla.insertRow(0);
	row.classList.add("row");
	var cervezas = traerCervezaSeleccionada();
	var value = cervezas.value.split('|');
	var precio = value[1];
	var descripcion = cervezas.text;
	switch(parseInt(litros.value))
	{
		case 1:
		var factor = 1;
		break;
		case 2:
		var factor = 0.95;
		break;
		case 3:
		var factor = 0.90;
		break;
		case 5:
		var factor = 0.85;
		break;
	}

	row.id=descripcion+'|'+value[0]+'|'+cantidad.value+'|'+precio+'|'+"cerveza"+'|'+litros.value+'|'+factor;
	var celda_desc = row.insertCell(0);
	var celda_sub = row.insertCell(1);
	var celda_eliminar = row.insertCell(2);
	var btn_eliminar = document.createElement('button');
	/* clase para boton */
	btn_eliminar.classList.add("btn2");
	//btn_eliminar.style.marginTop = "-16px";
	/* fin clase para boton */
	var btn_agregar = document.getElementById('btnAddC'); 
	celda_eliminar.appendChild(btn_eliminar);
	btn_eliminar.innerHTML = 'x';
	btn_eliminar.onclick = function eliminar(){
		removeAllChilds(row.id,true);

		if(tabla.rows.length == 0){
				document.getElementById("btnModal").disabled=true;
		}
	}
		celda_desc.classList.add("col-md-5");
	celda_sub.classList.add("col-md-5");
	celda_eliminar.classList.add("col-md-2");

	celda_desc.innerHTML = descripcion+' x'+cantidad.value;
	celda_sub.innerHTML = parseInt(precio) * parseInt(cantidad.value);
	
	}
}
function agregarP()
{
	
	var cantidad = traerCantidadDeProductoSeleccionado();
	if(parseInt(cantidad.value) > 0){
	document.getElementById("btnModal").disabled=false;
	var tabla  = document.getElementById("remito").getElementsByTagName('tbody')[0];
	var row = tabla.insertRow(0);
	row.classList.add("row");
	var producto = traerProductoSeleccionado();
	var value = producto.value.split('|');
	var precio = value[1];
	var descripcion = producto.text;
	row.id=descripcion+'|'+value[0]+'|'+cantidad.value+'|'+precio+'|'+"producto";
	var celda_desc = row.insertCell(0);   	///cambie los indices
	var celda_sub = row.insertCell(1);
	var celda_eliminar = row.insertCell(2);
	var btn_eliminar = document.createElement('button');
	btn_eliminar.classList.add("btn2");
	//btn_eliminar.style.marginTop = "-16px";
	var btn_agregar = document.getElementById('btnAddP'); 

	celda_eliminar.appendChild(btn_eliminar);
	btn_eliminar.innerHTML = 'x';

	btn_eliminar.onclick = function eliminar(){
		removeAllChilds(row.id,true);
		var flag = verificarDescripcion(traerProductoSeleccionado().text,btn_agregar);
		if(!flag)
		{
			btn_agregar.disabled = false;
		}

		if(tabla.rows.length == 0){
				document.getElementById("btnModal").disabled=true;
		}
	}


		celda_desc.classList.add("col-md-5");
	celda_sub.classList.add("col-md-5");
	celda_eliminar.classList.add("col-md-2");

	celda_desc.innerHTML = descripcion+' x'+cantidad.value;
	celda_sub.innerHTML = parseInt(precio) * parseInt(cantidad.value);

	document.getElementById('btnAddP').disabled = true;
	
	}

}
function crearOptions(cantidad , select)
{

	for(var i=0;i<=cantidad;i++)
	{
		var opt = document.createElement('option');
	opt.value = i;
	opt.innerHTML = i;
	select.appendChild(opt);
	}


}

function traerCantidadDeCervezaSeleccionada()
{
	var lista = document.getElementById('cantidadC');
	var opcion = lista.selectedIndex;
	var value = lista.options[opcion];
	return value;
}
function traerCervezaSeleccionada()
{
	var lista = document.getElementById('lista_c');
	var opcion = lista.selectedIndex;
	var value = lista.options[opcion];
	return value;
}
function traerCantidadDeProductoSeleccionado()
{
	var lista = document.getElementById('cantidadP');
	var opcion = lista.selectedIndex;
	var value = lista.options[opcion];
	return value;
}
function traerProductoSeleccionado()
{
	var lista = document.getElementById("lista");
	var opcion = lista.selectedIndex;
	var value = lista.options[opcion];
	return value;
}

function actualizarProductos()
{
	var producto = traerProductoSeleccionado();
	var value = producto.value.split("|");
	var precio = value[1];
	var stock = value[2];
	document.getElementById("valor").innerHTML = precio;

	var select = document.getElementById('cantidadP');
	if(select.length > 0){
		removeAllChilds('cantidadP' , false);
	}

	crearOptions(stock,select);
	var btn_agregar = document.getElementById('btnAddP');
	var flag = verificarDescripcion(producto.text,btn_agregar);

	if(!flag)
	{
		btn_agregar.disabled = false;
	}
}

function actualizarCervezas()
{
	var cervezas = traerCervezaSeleccionada();
	var value = cervezas.value.split("|");
	var precio = value[1];
	var stock = value[2];
	document.getElementById("valorC").innerHTML = precio;
	var select = document.getElementById('cantidadC');
	
	if(select.length > 0){
		removeAllChilds('cantidadC' , false);
	}
	crearOptions(stock,select);

}

function verificarListasCargadas()
{
	var lista_p = document.getElementById('lista');
	var lista_c = document.getElementById('lista_c');

	if(lista_p != null)
	{
		actualizarProductos();
	}

	if(lista_c != null)
	{
		actualizarCervezas();
	}

	document.getElementById("btnModal").disabled=true;
}

verificarListasCargadas();