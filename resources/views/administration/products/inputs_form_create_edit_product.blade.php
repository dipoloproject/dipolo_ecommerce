<div class="row">
    <!-- PRIMERA COLUMNA -->
    <div class="col-md-6">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Marca</label>
                <select class="form-control select2" 
                        name="input_marca"        
                        id="input_marca"
                        style="width: 100%;">
                                <option value="" selected>-</option>
                    <?php   foreach($marcas as $marca):     ?>
                                <option value="{{$marca->idMarca}}">{{$marca->nombreMarca}}</option>    
                    <?php   endforeach;                     ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Modelo</label>
                <select class="form-control select2 select_input_modelo" 
                        name="input_modelo"
                        id="input_modelo"
                        style="width: 100%;">
                                <option value="" selected>-</option>
                        <!-- EL RESTO DE OPCIONES SE GENERA CON JAVASCRIPT -->
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Categoría</label>
                <select class="form-control select2" 
                        name="input_categoria"
                        id="input_categoria"
                        style="width: 100%;">
                                <option value="" selected>-</option>
                    <?php       
                                echo  createTreeView( null, $menus, 0); 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nombre</label>
                <input  type="text" 
                        class="form-control" 
                        name="input_nombre" 
                        id="input_nombre" 
                        placeholder="Nombre del producto"
                        value="">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Es destacado</label>
                <select class="form-control select2" 
                        name="input_es_destacado"
                        id="input_es_destacado"
                        style="width: 100%;">
                                <option value="" selected>-</option>
                                <option value="N">NO</option>
                                <option value="S">SI</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Stock</label>
                <input  type="number" class="form-control" 
                        name="input_stock" id="input_stock"
                        step="1" min="0" oninput="validity.valid||(value='');"
                        value="">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Condición</label>
                <select class="form-control select2" 
                        name="input_condicion"
                        id="input_condicion"
                        style="width: 100%;">
                                <option value="" selected>-</option>
                                <option value="N">Nuevo</option>
                                <option value="U">Usado</option>
                </select>
            </div>

            <?php   if($create_edit=='create'){     ?>
                        @include ('administration/products/input_form_create_files')
            <?php   }else{                          ?>
                        @include ('administration/products/input_form_edit_files')
            <?php   }                               ?>
            
            <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            
        </div>
        <!-- /.card-body -->
    </div><!-- /.col-md-6 -->
    <!--\.PRIMERA COLUMNA -->

    <!-- SEGUNDA COLUMNA -->
    <div class="col-md-6">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputPassword1">Código</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <input  type="text" 
                        class="form-control" 
                        name="input_codigo" 
                        id="input_codigo" 
                        placeholder="Código del producto"
                        value="">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Descripción</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <input  type="text" 
                        class="form-control" 
                        name="input_descripcion" 
                        id="input_descripcion" 
                        placeholder="Descripción del producto"
                        value="">
            </div>

            <!-- NO SE MOSTRARÁ SUBCATEGORÍA. esto ya se establece en el input Categoría -->
            <!-- <div class="form-group">
                <label for="exampleInputPassword1">Sub-categoría</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <select class="form-control select2" 
                        name="input_subcategoria"
                        id="input_subcategoria"
                        style="width: 100%;">
                                <option value="" selected>-</option>
                </select>
            </div> -->
            
            <div class="form-group">
                <label for="exampleInputPassword1">Origen</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <select class="form-control select2" 
                        name="input_origen"
                        id="input_origen"
                        style="width: 100%;">
                                <option value="" selected>-</option>
                    <?php   foreach($origenes as $origen):     ?>
                                <option value="{{$origen->origen}}">{{$origen->origen}}</option>
                    <?php   endforeach;                     ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Precio tachado</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <input  type="number" 
                        class="form-control" 
                        name="input_precio_tachado" 
                        id="input_precio_tachado"
                        placeholder="0.00"
                        oninput="limitDecimalPlaces(event, 2)"
                        value="">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Precio venta</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <input  type="number" 
                        class="form-control" 
                        name="input_precio_venta" 
                        id="input_precio_venta"
                        placeholder="0.00"
                        oninput="limitDecimalPlaces(event, 2)"
                        value="">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Precio Lista</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <input  type="number" 
                        class="form-control" 
                        name="input_precio_lista" 
                        id="input_precio_lista"
                        placeholder="0.00"
                        oninput="limitDecimalPlaces(event, 2)"
                        value="">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Orden</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <input  type="number" 
                        class="form-control" 
                        name="input_orden" 
                        id="input_orden"
                        step="1" min="0" oninput="validity.valid||(value='');"
                        value="">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Vistas</label>&nbsp;<span class="text-secondary">(opcional)</span>
                <input  type="number" 
                        class="form-control" 
                        name="input_vistas" 
                        id="input_vistas"
                        step="1" min="0" oninput="validity.valid||(value='');"
                        value="">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Estado</label>
                <select class="form-control select2" 
                        name="input_estado"
                        id="input_estado"
                        style="width: 100%; font-weight: bold;">
                                <!-- <option value="" selected>-</option> -->
                                <option value="A" selected>ACTIVO</option>
                                <option value="I">INACTIVO</option>
                </select>
            </div>
            <!-- <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            
        </div>
        <!-- /.card-body -->
    </div><!-- /.col-md-6 -->
    <!--\.SEGUNDA COLUMNA -->
</div>