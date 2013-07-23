@extends('layouts.scaffold')

@section('main')

<h1>Show Test</h1>

<p>{{ link_to_route('tests.index', 'Return to all tests') }}</p>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Author</th>
				<th>Body</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{{ $test->author }}}</td>
					<td>{{{ $test->body }}}</td>
                    <td>{{ link_to_route('tests.edit', 'Edit', array($test->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('tests.destroy', $test->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
        </tr>
    </tbody>
</table>

@stop