// JavaScript Document
$(document).ready(init);

//Atributos
var map;
var marcadores=[];
var ventanaArray=[];
var ultimoId=1;

//Metodos
function init() {
	crearGoogleMap(3.4206, -76.5222);
	genrearMakerJson("negocios_agregados.json?mini=1&desde="+ultimoId, false);
	formAjax();
	
	setInterval(function(){
		genrearMakerJson("negocios_agregados.php?mini=1&desde="+(parseInt(ultimoId)+1) ,true);
	}, 3000);
}
  
function genrearMakerJson(urlJson, mostrarInfo){
	$.getJSON(urlJson,
		  function(data) {
			$.each(data, function(i,json){
				
				crearMarker(json.id, json.nombre, json.direccion,  json.categoria, json.latitud, json.longitud, mostrarInfo);
				ultimoId=json.id;
				
			});
		  });
}

//se usa en generarMakerJson
function crearMarker(id, nombre, direccion, icono, ilatitud, ilongitud, mostrarInfo){
	icono='img/categorias/'+icono+'.png';
	var localizacion = new google.maps.LatLng(ilatitud, ilongitud);
	
	var marker = new google.maps.Marker({
		  position: localizacion, 
		  map: map,
		 //draggable:true,
		 animation: google.maps.Animation.DROP,
		 icon: icono
	  });

	  marcadores.push(marker); //Agrego marcador a una lista de marcadres
	  //Elimino todas las ventanas
	   delVentans();
	   
	   //Evento mover mouse
	  google.maps.event.addListener(marker, 'mouseover', 
	  function (){
		  makerMouseOver(nombre, direccion, localizacion, mostrarInfo);
	  });
	  
	  //evento click
	  google.maps.event.addListener(marker, 'click', 
	  function (){
		 clickMarker(id);
		 map.setCenter(localizacion);
		 
	  });
	  if (mostrarInfo)
	  	makerMouseOver(nombre, direccion, localizacion, mostrarInfo);
}

function makerMouseOver(nombre, direccion, localizacion, mostrarInfo){
	delVentans();
	var ventana = newInfoMap(nombre, direccion, localizacion);
	ventanaArray.push(ventana);
	ventana.open(map);
}

function clickMarker(id){
	  var x=$("#cajainfo");
	  x.hide()
	  
	  
	  x.load('bloques/mas_informacion.php?id='+id);
	  x.fadeIn("slow"); 
	  return false;	 
}

function delVentans() {
  if (ventanaArray) {
    for (i in ventanaArray) {
      ventanaArray[i].setMap(null);
    }
    ventanaArray.length = 0;
  }
}

function newInfoMap(nombre, direccion, localizacion){
	if (direccion=="")
		direccion=' ninguna';
	 return new google.maps.InfoWindow(
		{ content: '<b>'+nombre+'</b><br> Direccion:'+direccion,
			size: new google.maps.Size(50,50),
			position: localizacion
		});
	}
	
function makerAnimacion(maker){
	if (marker.getAnimation() != null) {
		marker.setAnimation(null);
	  } else {
		marker.setAnimation(google.maps.Animation.BOUNCE);
	  }
}

function crearGoogleMap(ilatitud, ilongitud){
	var latlng = new google.maps.LatLng(ilatitud, ilongitud);
    var myOptions = {
      zoom: 12,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("mapa"), myOptions);
	
	google.maps.event.addListener(map, 'click', function(){
		delVentans();
		$('#cajainfo').text(" Haz click en un marcador");	
	});
}

function formAjax(){		
	$("#btnform").click(function() {
		
		var url = $("#url").val();
    	var categoria = $("#categoria").val();
		var x2 = $("#respuesta");
		
		//var vars =  $('#form1').serialize();
 
 		if (url == "") {
            $("#url").focus();
		}
		else if (categoria == "") {
            $("#categoria").focus();
		}else{	
		   x2.fadeOut("slow"); //final es un div donde se mostrara el mensaje de error al usuario
		   $.ajax({
			   type: "POST",
			   contentType:"application/x-www-form-urlencoded", 
			   url:"bloques/agregar_nuevo_negocio.php", //Archivo donde se hace la consulta a la base de datos para verificar si existe el usuario
			   data:"url="+url+"&categoria="+categoria,
			   success:function(msg){ 
					x2.fadeIn("slow",function(){ 
						x2.html(msg); 
			   		}) 
			   }
			}) 
		    
		 }
		
	 	return false;
	 });
}