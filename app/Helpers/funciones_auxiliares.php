<?php 

    function debbug($variable){
        echo "<pre>";var_dump($variable);
        exit;
    }


    function modelresult_to_datatables($resultset){
        //  vector a retornar
            $array = array();
        //  Recorre cada fila del resultset
            foreach($resultset as $object){
                $result = json_encode($object);
                // convert object $result to array
                    $array_asoc = json_decode($result, true);

                array_push($array, $array_asoc);
            }
        //  devuelve un array de elementos (de tipo array)
            return $array;
   }


    function modelresult_to_ajax($resultset){
         // Determina la cantidad de columnas que posee el resultset
            $cant_fields= sizeof($resultset);  //echo $cant_fields;exit;
            
        //  Determina si el resultset es un vector de objetos o de un unico objeto 
            if($cant_fields==1){
                //  recibe un array de objeto
                    $result = json_encode($resultset[0]);
                //  convert object $result to array
                    $element = json_decode($result, true);
                //  devuelve un elemento array
                    return $element;
            }else{
                //  vector a retornar
                    $array = array();
                //  Recorre cada fila del resultset
                    foreach($resultset as $object){
                        $result = json_encode($object);
                        // convert object $result to array
                            $array_asoc = json_decode($result, true);

                        array_push($array, $array_asoc);
                    }
                //  devuelve un array de elementos (de tipo array)
                    return $array;
            }// \.if/else
    }



?>