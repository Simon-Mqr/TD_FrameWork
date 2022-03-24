<?php
return array("/store/section/(.+?)/"=>["get"=>["controller"=>"controllers\\StoreController","action"=>"getOneSection","parameters"=>[0],"name"=>"store.section","cache"=>false,"duration"=>0]],"/store/allProducts/"=>["get"=>["controller"=>"controllers\\StoreController","action"=>"getAllProducts","parameters"=>[],"name"=>"store.getAllProducts","cache"=>false,"duration"=>0]]);
