@extends('layouts.scaffold')

@section('main')

<h1>All Tests</h1>

<p>{{ link_to_route('tests.create', 'Add new test') }}</p>

@if ($tests->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Author</th>
				<th>Body</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tests as $test)
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
            @endforeach
        </tbody>
    </table>
@else
    There are no tests
@endif

@stop