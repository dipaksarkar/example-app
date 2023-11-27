<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Car</title>
</head>
<body>
    @error('model')
        <div>{{$message}}</div>
    @enderror
    <form action="{{route('cars.store')}}" method="post">
        @csrf
        <input type="text" name="model" />
        <input type="text" name="make" />
        <input type="date" name="produced_on" />

        <button type="submit">
            Submit
        </button>
    </form>
</body>
</html>
