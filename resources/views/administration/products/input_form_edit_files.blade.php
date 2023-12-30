<div class="form-group">
    <label  for="exampleInputPassword1" 
            class="text-black" 
            id="label_field_reorder_mediafiles">Reordenar archivos multimedia</label>
    <!-- VISTA PREVIA de archivos precargados -->
        <div class="row px-5">
            <!-- <div class="col-md-1"></div> -->
            <div class="col-md-12 px-0">
                <!-- <label for="exampleInputFile">Vista previa (archivos precargados)</label> -->
                <div class="rounded grey_area_reorder" 
                    id="galeria_sortable" 
                    style="background-color:#e9ecef;">
                    <div id="fileList_sortable" class="row px-2" style="width:100%;">
                        <?php
                            foreach($archivos as $archivo ):
                        ?>
                                <div class="lg-image-reorder" 
                                    style="cursor:grab;"
                                    data-id="{{$archivo->idArchivoMultimedia}}">
                                    <img    style="padding:5px;" 
                                            src="../../../storage/archivos_multimedia/{{$archivo->nombreArchivoMultimedia}}" 
                                            alt="product image" 
                                            width="100px;" height="100px;">
                                </div>
                        <?php
                            endforeach;
                        ?>
                                    <!-- <img style="padding:5px;"  width="100" src="../../storage/archivos_multimedia/65445e2d33867_2.jpg"> -->
                    </div>
                </div>
            </div>
        </div>
    <!-- \.VISTA PREVIA de archivos precargados -->
</div>

<div class="form-group">
    <label for="exampleInputFile">Imágenes</label>
    <div class="input-group">
        <div class="custom-file">
            <input  type="file" multiple 
                    class="custom-file-input" 
                    name="file"
                    id="inputArchivos"
                    accept="image/*"
                    onchange="javascript:updateList(event)">
                    <!-- al cargar archivos, se ejecuta la funcion updateList() -->
                    
            <label  class="custom-file-label" 
                    for="exampleInputFile">Volver a elegir archivos</label>
            <!-- <output id="list"></output> -->
        </div>
        <!-- <div class="preview-area" id="preview_files" style="width: 300px;">asdfasdfasdfasfads</div> -->                                        
        <!-- <div class="input-group-append">
            <span class="input-group-text">Upload</span>
        </div> -->
    </div>
    <!-- NOTIFICACION-ALERTA sobre archivos precargados (para subir) -->
        <div class="alert alert-danger fade mb-0 py-1 mb-2" 
            id="input_archivos_alert"
            style="background-color:#f8d7da;color:#721c24;" 
            role="alert">&nbsp;</div>
    <!-- \.NOTIFICACION-ALERTA sobre archivos precargados (para subir) -->
    <!-- VISTA PREVIA de archivos precargados -->
        <div class="row px-5">
            <!-- <div class="col-md-1"></div> -->
            <div class="col-md-12">
                <label for="exampleInputFile">Vista previa (archivos precargados)</label>
                <div class="rounded" 
                    id="galeria_edit" 
                    style="background-color:#e9ecef;">
                    <div id="fileList_edit" 
                         class="row d-flex justify-content-center" 
                         style="width:100%;">
                        <h5 class="text-center m-0 py-2">No se cargaron archivos</h5>
                    </div>
                </div>
            </div>
        </div>
    <!-- \.VISTA PREVIA de archivos precargados -->                                    
</div>