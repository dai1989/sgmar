<?php
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Persona;

use App\DetalleIngreso;

use App\DetallePresupuesto;
use App\DetalleVenta;
use App\Ingreso;

use App\Presupuesto;
use App\Venta;

use App\User;

use App\Role;
use App\Option;
use App\Estimacion;
use App\DetalleEstimacion;

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Inicio', route('home'));
});





Breadcrumbs::register('login', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Iniciar Sesión', route('login'));
});

Breadcrumbs::register('register', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Registrarse', route('register'));
});


#Categoria
Breadcrumbs::register('categorias.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Categorias', route('categorias.index'));
});

Breadcrumbs::register('categorias.create', function($breadcrumbs)
{
    $breadcrumbs->parent('categorias.index');
    $breadcrumbs->push('Crear Categoría', route('categorias.create'));
});

Breadcrumbs::register('categorias.edit', function($breadcrumbs, $id)
{
    $cat = Categoria::findOrFail($id);
    $breadcrumbs->parent('categorias.index');
    $breadcrumbs->push('Editar Categoría: '.$cat->categoria_descripcion, route('categorias.edit', $cat->id));
});

#Articulo
Breadcrumbs::register('productos.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Producto', route('productos.index'));
});




Breadcrumbs::register('productos.create', function($breadcrumbs)
{
    $breadcrumbs->parent('productos.index');
    $breadcrumbs->push('Crear Artículo', route('productos.create'));
});

Breadcrumbs::register('productos.edit', function($breadcrumbs, $id)
{
    $cat = Producto::findOrFail($id);
    $breadcrumbs->parent('productos.index');
    $breadcrumbs->push('Editar Artículo: '.$cat->descripcion, route('productos.edit', $cat->idproducto));
});

Breadcrumbs::register('productos.show', function($breadcrumbs, $id)
{
    $cat = Producto::findOrFail($id);
    $breadcrumbs->parent('productos.index');
    $breadcrumbs->push('Vista: '.$cat->descripcion, route('productos.edit', $cat->idproducto));
});



#Presupuesto
Breadcrumbs::register('presupuesto.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Recaudación Diaria', route('presupuesto.index'));
});

Breadcrumbs::register('presupuesto.create', function($breadcrumbs)
{
    $breadcrumbs->parent('presupuesto.index');
    $breadcrumbs->push('Nuevo Recaudamiento', route('presupuesto.create'));
});

Breadcrumbs::register('presupuesto.show', function($breadcrumbs, $id)
{
    $cat = Presupuesto::findOrFail($id);
    $breadcrumbs->parent('presupuesto.index');
    $breadcrumbs->push('Detalle del Recaudamiento: '.$cat->fecha_hora, route('presupuesto.show', $cat->idpresupuesto));
});

#Clientes
Breadcrumbs::register('clientes.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Cliente', route('clientes.index'));
});

Breadcrumbs::register('clientes.create', function($breadcrumbs)
{
    $breadcrumbs->parent('clientes.index');
    $breadcrumbs->push('Crear Cliente', route('clientes.create'));
});

Breadcrumbs::register('clientes.edit', function($breadcrumbs, $id)
{
    $cat = Persona::findOrFail($id);
    $breadcrumbs->parent('clientes.index');
    $breadcrumbs->push('Editar Cliente: '.$cat->nombre, route('cliente.edit', $cat->id));
});

#Ventas
Breadcrumbs::register('venta.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Venta', route('venta.index'));
});

Breadcrumbs::register('venta.create', function($breadcrumbs)
{
    $breadcrumbs->parent('venta.index');
    $breadcrumbs->push('Crear Venta', route('venta.create'));
});

Breadcrumbs::register('venta.show', function($breadcrumbs, $id)
{
    $cat = Venta::findOrFail($id);
    $breadcrumbs->parent('venta.index');
    $breadcrumbs->push('Detalle de la Venta', route('venta.show', $cat->idventa));
});

Breadcrumbs::register('ticke', function($breadcrumbs, $id)
{
    $cat = Venta::findOrFail($id);
    $breadcrumbs->parent('venta.index');
    $breadcrumbs->push('Detalle de la Venta', route('ticke', $cat->idventa));
});


#Mensual






#Proveedor
Breadcrumbs::register('proveedores.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Proveedor', route('proveedores.index'));
});

Breadcrumbs::register('proveedores.create', function($breadcrumbs)
{
    $breadcrumbs->parent('proveedores.index');
    $breadcrumbs->push('Crear proveedores', route('proveedores.create'));
});

Breadcrumbs::register('proveedores.edit', function($breadcrumbs, $id)
{
    $cat = Proveedor::findOrFail($id);
    $breadcrumbs->parent('proveedores.index');
    $breadcrumbs->push('Editar Proveedor: '.$cat->razonsocial, route('proveedores.edit', $cat->id));
});

#Ingreso
Breadcrumbs::register('ingreso.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ingresos', route('ingreso.index'));
});

Breadcrumbs::register('ingreso.create', function($breadcrumbs)
{
    $breadcrumbs->parent('ingreso.index');
    $breadcrumbs->push('Crear Ingreso', route('ingreso.create'));
});

Breadcrumbs::register('ingreso.show', function($breadcrumbs, $id)
{
    $cat = Ingreso::findOrFail($id);
    $breadcrumbs->parent('ingreso.index');
    $breadcrumbs->push('Detalle del ingreso', route('ingreso.show', $cat->idingreso));
});

#regatar noticia
Breadcrumbs::register('password.reset', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Recuperar Contraseña', route('password.reset'));
});


#Usu



#Config






//estimacion
Breadcrumbs::register('estimacion.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Presupuestos', route('estimacion.index'));
});

Breadcrumbs::register('estimacion.create', function($breadcrumbs)
{
    $breadcrumbs->parent('estimacion.index');
    $breadcrumbs->push('Crear presupuesto', route('estimacion.create'));
});

Breadcrumbs::register('estimacion.show', function($breadcrumbs, $id)
{
    $cat = Estimacion::findOrFail($id);
    $breadcrumbs->parent('estimacion.index');
    $breadcrumbs->push('Detalle del presupuesto', route('estimacion.show', $cat->idestimacion));
});

Breadcrumbs::register('estimacionventa', function($breadcrumbs, $id)
{
    $cat = Estimacion::findOrFail($id);
    $breadcrumbs->parent('estimacion.index');
    $breadcrumbs->push('Realizar Venta: '. $cat->fecha_hora, route('estimacionventa', $cat->idestimacion));
});










