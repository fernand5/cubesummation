@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="content">
            <h2 style="text-align: center;">Introduce the data</h2>

            <div class="alert alert-danger" ></div>

            <form id="formCube" action="{{ url('/calculate') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="comment">Values</label>
                    <textarea id="areaData" name="textAreaValues" class="form-control" rows="5" id="comment"></textarea>
                </div>
                <div class="form-group">
                    <input id="submitButton" type="submit" value="Calculate" class="btn btn-form">
                </div>

            </form>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <h1> Result section </h1>

                    <textarea id="readOnlyResults" rows="15" cols="50" readonly></textarea>

                </div>
            </div>
            <hr />
            <div class="row">
                <h3>Sample Input</h3>
                <pre>2<br>4 5<br>UPDATE 2 2 2 4<br>QUERY 1 1 1 3 3 3<br>UPDATE 1 1 1 23<br>QUERY 2 2 2 4 4 4<br>QUERY 1 1 1 3 3 3<br>2 4<br>UPDATE 2 2 2 1<br>QUERY 1 1 1 1 1 1<br>QUERY 1 1 1 2 2 2<br>QUERY 2 2 2 2 2 2</pre>
            </div>
            <div class="row">
                <h3>Sample Output</h3>
                <pre>4<br>4<br>27<br>0<br>1<br>1</pre>
            </div>
        </div>
    </div>
@stop

