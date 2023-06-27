<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Answer 1</th>
                    <th scope="col">Answer 2</th>
                    <th scope="col">Answer 3</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->answer_a }}</td>
                    <td>{{ $question->answer_b }}</td>
                    <td>{{ $question->answer_c }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>
