@extends("admin.layouts.app")

@section("title", "Site Settings")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">Header Settings</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    {{ Form::open(['route' => ['settings.store'], 'files' => true, 'class' => 'form-horizontal']) }}
                    <div class="row">
                        <input type="hidden" name="type" value="header">
                        @foreach($headers as $key => $header)
                            @if($header->field_type === "text")
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 mt-20">
                                    @php $field_type = $header->field_type; @endphp
                                    <label class="control-label" for="{{ $header->name }}">
                                        {{ ucfirst(str_replace('_',' ', $header->name)) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    {!! Form::$field_type($header->name, old($header->name, $header->value), ['id'=> $header->name,'class' => 'form-control', 'required', 'placeholder' => ucfirst(str_replace('_',' ', $header->name))]) !!}
                                    {!! $errors->first($header->name, '<label id="'.$header->name.'-error" class="validation-error-label" for="'.$header->name.'">:message</label>') !!}
                                </div>
                            @elseif($header->field_type === 'textarea')
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 mt-20">
                                    @php $field_type = $header->field_type; @endphp
                                    <label class="control-label" for="{{ $header->name }}">
                                        {{ ucfirst(str_replace('_',' ', $header->name)) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    {!! Form::$field_type($header->name, old($header->name, $header->value), ['id'=> $header->name,'class' => 'form-control', 'rows' => '2', 'required', 'placeholder' => ucfirst(str_replace('_',' ', $header->name))]) !!}
                                    {!! $errors->first($header->name, '<label id="'.$header->name.'-error" class="validation-error-label" for="'.$header->name.'">:message</label>') !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row mt-20">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn bg-slate-700">Submit</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">Footer Settings</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    {{ Form::open(['route' => ['settings.store'], 'files' => true, 'class' => 'form-horizontal']) }}
                    <div class="row">
                        <input type="hidden" name="type" value="footer">
                        @foreach($footers as $key => $footer)
                            @if($footer->field_type === "text")
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 mt-20">
                                    @php $field_type = $footer->field_type; @endphp
                                    <label class="control-label" for="{{ $footer->name }}">
                                        {{ ucfirst(str_replace('_',' ', $footer->name)) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    {!! Form::$field_type($footer->name, old($footer->name, $footer->value), ['id'=> $footer->name,'class' => 'form-control', 'required', 'placeholder' => ucfirst(str_replace('_',' ', $footer->name))]) !!}
                                    {!! $errors->first($footer->name, '<label id="'.$footer->name.'-error" class="validation-error-label" for="'.$footer->name.'">:message</label>') !!}
                                </div>
                            @elseif($footer->field_type === 'textarea')
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 mt-20">
                                    @php $field_type = $footer->field_type; @endphp
                                    <label class="control-label" for="{{ $footer->name }}">
                                        {{ ucfirst(str_replace('_',' ', $footer->name)) }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    {!! Form::$field_type($footer->name, old($footer->name, $footer->value), ['id'=> $footer->name,'class' => 'form-control', 'rows' => '2', 'required', 'placeholder' => ucfirst(str_replace('_',' ', $footer->name))]) !!}
                                    {!! $errors->first($footer->name, '<label id="'.$footer->name.'-error" class="validation-error-label" for="'.$footer->name.'">:message</label>') !!}
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row mt-20">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn bg-slate-700">Submit</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
