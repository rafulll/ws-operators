<?php

/*
	Regras da relação entre loja, operador e bandeira
*/
define("RULES", serialize(
    array(
		"op-01" => array(
			"bandeiras_autorizadas" => array(
				"mister" => true,
				"vista" => true,
				"daciolo" => true
			),
			"lojas_autorizadas" => array(
				"loja-01" => true,
				"loja-02" => true,
				"loja-03" => true
			)
		),
		"op-02" => array(
			"bandeiras_autorizadas" => array(
				"vista" => true
			),
			"lojas_autorizadas" => array(
				"loja-02" => true
			)
		),
		"op-03" => array(
			"bandeiras_autorizadas" => array(
				"daciolo" => true
			),
			"lojas_autorizadas" => array(
				"loja-03" => true
			)
		)
    )
));