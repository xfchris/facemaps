<?php
//usa funciones de Funciones.php

class FacebookObj{
	//Atributos
	var $atributos;
	var $linkFacebook;
	var $codeURL;
	
	//metodo Constructor
	public function FacebookObj($linkFacebook){
		//Extraigo el link del facebook
		$linkFacebook=explode('/',$linkFacebook);
		$linkFacebook=$linkFacebook[count($linkFacebook)-1];
		
		if ($linkFacebook){
			$this->linkFacebook=$linkFacebook;
			$this->codeURL=extraerDatosUrl('http://graph.facebook.com/'.$linkFacebook); 
			
			$this->codeURL='['.$this->codeURL.']';
			
		
			$this->atributos=current(json_decode($this->codeURL, true));
		}
	}
	
	
	public function getAtributosEnArray(){
		
		
		$arrayFacebook['nombre']=$this->atributos['name'];
		if ($this->atributos['username'])
			$arrayFacebook['nickfacebook']=$this->atributos['username'];
		else
			$arrayFacebook['nickfacebook']=$this->atributos['id'];
		
		$arrayFacebook['imagen']=$this->atributos['picture'];
		$arrayFacebook['direccion']=$this->atributos['location']['street'];
		$arrayFacebook['telefono']=$this->atributos['phone'];
		$arrayFacebook['paginaweb']=$this->atributos['website'];
		$arrayFacebook['latitud']=$this->atributos['location']['latitude'];
		$arrayFacebook['longitud']=$this->atributos['location']['longitude'];
		
		return $arrayFacebook;
	}
	
		
	public function comprobarQueSeaNegocio(){
		if ($this->linkFacebook){ 
					
			if (stristr($this->codeURL, '"error": {') 
				||	!$this->atributos['location']['latitude'] 
				||	!$this->atributos['category'] ) {
				return 0;
				}
			return 1;
		}
		
	}
	
}