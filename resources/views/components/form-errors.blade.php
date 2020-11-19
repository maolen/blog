@if($errors->any())

    <ul style="color: #ff0000; font-size: 80%;">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

@endif
