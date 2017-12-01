<?php

namespace Hcode;

use Rain\Tpl;

class Page {

	private $tpl;
	private $options = [];
	private $defaults = [
		"data"=>[]
	];

	public function __construct($opt = array()){

		$this->options = array_merge($this->defaults, $opt);

		$config = array(
					"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
					"cache_dir"     => "views-cache/",
					"debug"         => false // set to false to improve the speed
				   );

	Tpl::configure( $config );

	$this->tpl = new Tpl;

	$this->setData($this->options["data"]);

	$this->tpl->draw("header"); //chama o cabeçalho da pagina

	} 

	private function setData($data = array()){
		foreach ($data as $key => $value) {
		
		$this->tpl->assign($key, $value);
	}
	}

	public function setTpl($name, $data = array(),$returnHTML = false){

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		$this->tpl->draw("footer"); //chama o rodapé da pagina

	}
}

?>