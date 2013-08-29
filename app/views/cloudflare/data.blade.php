<table class="table">
    <thead>
        <th>Type</th>
        <th>Regular</th>
        <th>Threat</th>
        <th>Crawler</th>
        <th>Total</th>
    </thead>
    <tbody>
        <tr>
            <td>Page Views</td>
            <td>{{ $data['pageviews']['regular'] }}</td>
            <td>{{ $data['pageviews']['threat'] }}</td>
            <td>{{ $data['pageviews']['crawler'] }}</td>
            <td>{{ $data['pageviews']['regular']+$data['pageviews']['threat']+$data['pageviews']['crawler'] }}</td>
        </tr>
        <tr>
            <td>Unique Visitors</td>
            <td>{{ $data['uniques']['regular'] }}</td>
            <td>{{ $data['uniques']['threat'] }}</td>
            <td>{{ $data['uniques']['crawler'] }}</td>
            <td>{{ $data['uniques']['regular']+$data['uniques']['threat']+$data['uniques']['crawler'] }}</td>
        </tr>
    </tbody>
</table>
