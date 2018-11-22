<compra>
    <div class="well well-sm">
        <div class="row">
            <div class="col-xs-6">
                <input id="proveedor" class="form-control typeahead" type="text" placeholder="Proveedor" />
            </div>
            <div class="col-xs-2">
                <input class="form-control" type="text" placeholder="cuit" readonly value="{cuit}" />
            </div>
            
        </div>
         <div class="row">
            <div class="col-xs-6">
                <input id="user" class="form-control typeahead" type="text" placeholder="Vendedor" />
            </div>
            <div class="col-xs-2">
                <input class="form-control" type="text" placeholder="username" readonly value="{username}" />
            </div>
            
        </div>
        <div class="row">
            <div class="col-xs-6">
                <input id="tipopago" class="form-control typeahead" type="text" placeholder="tipo de pago" />
            </div>
            <div class="col-xs-6">
                <input id="tipofactura" class="form-control typeahead" type="text" placeholder="tipo de factura" />
            </div>
          
            
            
        </div>
    </div>

    <div class="row">
        <div class="col-xs-7">
            <input id="producto" class="form-control" type="text" placeholder="Nombre del producto" />
        </div>
        <div class="col-xs-2">
            <input id="cantidad" class="form-control" type="text" placeholder="Cantidad" />
        </div>
         <div class="col-xs-2">
            <div class="input-group">
                <span class="input-group-addon" id="precio">S/.</span>
                <input class="form-control" type="text" placeholder="Precio"/>
            </div>
        </div>
       
        <div class="col-xs-1">
            <button onclick={__addProductoToDetail} class="btn btn-primary form-control" id="btn-agregar">
                <i class="glyphicon glyphicon-plus"></i>
            </button>
        </div>
    </div>

    <hr />

    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width:40px;"></th>
            <th>Producto</th>
            <th style="width:100px;">Cantidad</th>
            <th style="width:100px;">P.U</th>
            <th style="width:100px;">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr each={detail}>
            <td>
                <button onclick={__removeProductoFromDetail} class="btn btn-danger btn-xs btn-block">X</button>
            </td>
            <td>{descripcion}</td>
            <td class="text-right">{cantidad}</td>
            <td class="text-right">$ {precio}</td>
            <td class="text-right">$ {total}</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-right"><b>IVA</b></td>
            <td class="text-right">$ {iva.toFixed(2)}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Sub Total</b></td>
            <td class="text-right">$ {subTotal.toFixed(2)}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total</b></td>
            <td class="text-right">$ {total.toFixed(2)}</td>
        </tr>
        </tfoot>
    </table>

    <button if={detail.length > 0 && proveedor_id > 0} onclick={__save} class="btn btn-default btn-lg btn-block">
        Guardar
    </button>

    <script>
        var self = this;

        // Detalle del comprobante
        self.proveedor_id = 0;
        self.tipopago_id = 0;
        self.tipofactura_id = 0;
        self.user_id = 0;
        self.detail = [];
        
        self.iva = 0;
        self.subTotal = 0;
        self.total = 0;

        self.on('mount', function(){
            __proveedorAutocomplete();
            __tipopagoAutocomplete();
            __tipofacturaAutocomplete();
            __userAutocomplete();
            __productoAutocomplete();
        })

        __removeProductoFromDetail(e) {
            var item = e.item,
                index = this.detail.indexOf(item);

            this.detail.splice(index, 1);
            __calculate();
        }

        __addProductoToDetail() { 
            self.detail.push({
                id: self.producto_id,
                descripcion: self.producto.value,
                cantidad: parseFloat(self.cantidad.value),
                precio: self.precio.value,
                
                
                total: parseFloat(self.precio.value* self.cantidad.value)
            });

            self.producto_id = 0;
            self.producto.value = '';
            self.cantidad.value = '';
            self.precio.value= '';

            __calculate();
        }

        __save() {
            $.post(baseUrl('compra/save'), {
                proveedor_id: self.proveedor_id,
                tipofactura_id: self.tipofactura_id,
                tipopago_id: self.tipopago_id,
                user_id: self.user_id,
                
                iva: self.iva,
                subTotal: self.subTotal,
                total: self.total,
                detail: self.detail
            }, function(r){
                if(r.response) {
                    window.location.href = baseUrl('compra');
                } else {
                    alert('Ocurrio un error');
                }
            }, 'json')
        }

        function __calculate() {
            var total = 0;

            self.detail.forEach(function(e){
                total += e.total;
            });

            self.total = total * 0.21 + total;
            self.subTotal = parseFloat(total * 0.21 + total);
            self.iva = parseFloat(total * 21 / 100);
        }

        function __proveedorAutocomplete(){
            var proveedor = $("#proveedor"),
                options = {
                url: function(q) {
                    return baseUrl('compra/findProveedor?q=' + q);
                },
                getValue: 'razonsocial',
                list: {
                    onClickEvent: function() {
                        var e = proveedor.getSelectedItemData();
                        self.proveedor_id = e.id;
                        self.cuit = e.cuit;
                        

                        self.update();
                    }
                }
            };

            proveedor.easyAutocomplete(options);
        }

          function __userAutocomplete(){
            var user = $("#user"),
                options = {
                url: function(q) {
                    return baseUrl('compra/findUser?q=' + q);
                },
                getValue: 'name',
                list: {
                    onClickEvent: function() {
                        var e = user.getSelectedItemData();
                        self.user_id = e.id;
                        self.username = e.username;
                        

                        self.update();
                    }
                }
            };

            user.easyAutocomplete(options);
        }

        function __productoAutocomplete(){
            var producto = $("#producto"),
                options = {
                url: function(q) {
                    return baseUrl('compra/findProducto?q=' + q);
                },
                getValue: 'descripcion',
                 list: {
                    onClickEvent: function() {
                        var e = producto.getSelectedItemData();
                        self.producto_id = e.id;
                        

                        self.update();
                    }
                }
             
            };

            producto.easyAutocomplete(options);
        }


        function __tipopagoAutocomplete(){
            var tipopago = $("#tipopago"),
                options = {
                url: function(q) {
                    return baseUrl('compra/findTipoPago?q=' + q);
                },
                getValue: 'descripcionpago',
                list: {
                    onClickEvent: function() {
                        var e = tipopago.getSelectedItemData();
                        self.tipopago_id = e.id;
                        

                        self.update();
                    }
                }
            };

            tipopago.easyAutocomplete(options);
        }
         function __tipofacturaAutocomplete(){
            var tipofactura = $("#tipofactura"),
                options = {
                url: function(q) {
                    return baseUrl('compra/findTipoFactura?q=' + q);
                },
                getValue: 'descripcion',
                list: {
                    onClickEvent: function() {
                        var e = tipofactura.getSelectedItemData();
                        self.tipofactura_id = e.id;
                        

                        self.update();
                    }
                }
            };

            tipofactura.easyAutocomplete(options);
        }
    </script>
</compra>