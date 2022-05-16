<?php
############
## Editar ##

//En el controlador
  public function edit($id)
    {
        //
        $productos=Productos::find($id);
        return view('productos.edit',compact('productos'));
    }


                        <form method="POST" action="{{ route('productos.update',$productos->id) }}"  role="form">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="codigo" id="codigo" class="form-control input-sm" value="{{$productos->codigo}}">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" class="form-control input-sm" value="{{$productos->nombre}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="descripcion" class="form-control input-sm"  placeholder="Resumen">{{$productos->descripcion}}</textarea>
                            </div>
                           
                          
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                    <a href="{{ route('productos.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>  

                            </div>
                        </form>





    public function update(Request $request, $id)    
    {
        $productos=Productos::find($id);
        $productos->update($request->all());
        return view('productos.show',compact('productos'));

    }

// en el modelo:
  protected $fillable = ['codigo', 'nombre', 'descripcion'];

###########
## Crear ## 

//en el archivo create.blade.php

  <form method="POST" action="{{ route('productos.store') }}"  role="form">
                            {{ csrf_field() }}
                           
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="codigo" id="codigo" class="form-control input-sm" value="">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nombre" id="nombre" class="form-control input-sm" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="descripcion" class="form-control input-sm"  placeholder="Resumen"></textarea>
                            </div>
                           
                          
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="submit"  value="Grabar" class="btn btn-success btn-block">
                                    <a href="{{ route('productos.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                </div>  

                            </div>
                        </form>


//En el controlador
    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $productos = new Productos([
            'codigo'      => $request->get('codigo'),
          'nombre'      => $request->get('nombre'),
          'descripcion'  => $request->get('descripcion')
        ]);

        $productos->save();
        return redirect('/productos');
    }        