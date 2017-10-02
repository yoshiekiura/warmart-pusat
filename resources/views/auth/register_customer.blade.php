@extends('layouts.app_login')

@section('content')
    {!! Form::open(['url' => url('/register'),'method' => 'post', 'class'=>'form-horizontal']) !!}
                             {{ csrf_field() }}
                                <div class="card card-login ">
                                    <div class="card-header text-center" data-background-color="blue">
                                        <h4 class="card-title">Registrasi Customer</h4>
                                 
                                    </div>
                              
                                    <div class="card-content">
                                        <div class="input-group ">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-group label-floating {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label class="control-label">Nama Customer</label>
                                                    {!! Form::text('name', null, ['class'=>'form-control','required','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                                
                                            </div>
                                        </div> 


                                        <div class="input-group ">
                                            <span class="input-group-addon">
                                                <i class="material-icons">local_phone</i>
                                            </span>
                                            <div class="form-group label-floating {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label class="control-label">No Telp Customer</label>
                                                    {!! Form::number('email', null, ['class'=>'form-control','required','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}

                                                
                                            </div>
                                        </div>
                                        
                                        <div class="input-group ">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating {{ $errors->has('no_telp') ? ' has-error' : '' }}">
                                                <label class="control-label">Email Customer</label>
                                                    {!! Form::email('no_telp', null, ['class'=>'form-control','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}

                                                
                                            </div>
                                        </div>

                                        <div class="input-group ">
                                            <span class="input-group-addon">
                                                <i class="material-icons">address</i>
                                            </span>
                                            <div class="form-group label-floating {{ $errors->has('alamat') ? ' has-error' : '' }}">
                                                <label class="control-label">Alamat Customer</label>
                                                    {!! Form::text('alamat', null, ['class'=>'form-control','required','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}

                                                
                                            </div>
                                        </div>

                                        <div class="input-group ">
                                            <span class="input-group-addon">
                                                <i class="material-icons">event</i>
                                            </span>
                                            <div class="form-group label-floating {{ $errors->has('tgl_lahir') ? ' has-error' : '' }}">
                                                <label class="control-label">Tanggal Lahir</label>
                                                    {!! Form::text('tgl_lahir', null, ['class'=>'form-control datepicker','required','readonly','autocomplete'=>'off']) !!}
                                                    {!! $errors->first('tgl_lahir', '<p class="help-block">:message</p>') !!}

                                                
                                            </div>
                                        </div>

                                        <div class="input-group ">
                                            <span class="input-group-addon">
                                                <i class="material-icons">room</i>
                                            </span> 
                                            <div class="form-group label-floating {{ $errors->has('kelurahan') ? ' has-error' : '' }}">
                                                <label class="control-label">Kelurahan</label>
                                                {!! Form::select('kelurahan', 
                                                [''=>'']+App\Kelurahan::pluck('nama','id')->all(),null
                                                , ['class'=>'form-control js-selectize-reguler', 'placeholder' => 'Silahkan Pilih','id'=>'pilih_kelurahan','required']) !!}
                                                {!! $errors->first('kelurahan', '<p class="help-block">:message</p>') !!} 
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label class="control-label">Password</label>
                                                <input type="password" class="form-control" name="password" >

                                                  @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                 @endif
                                            </div>
                                        </div>  
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Konfirmasi Password</label>
                                                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" >

                                             
                                            </div>
                                        </div>
                                          {!! Form::hidden('id_register', 1, ['class'=>'form-control','autocomplete'=>'off']) !!}
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Registrasi Costomer</button>
                                    </div>
                                </div>
    {!! Form::close() !!}
@endsection
