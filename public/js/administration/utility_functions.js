//  FUNCIONES DE UTILIDAD

    function delete_options_by_select_id(id_elemento_html){
        var input_select= document.getElementById(id_elemento_html);
        while ( input_select.hasChildNodes() ) {
            input_select.removeChild(input_select.lastChild)
        }
    }

