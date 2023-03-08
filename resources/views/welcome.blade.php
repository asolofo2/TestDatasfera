<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2 mb-3 mt-5">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title">Сделки</h5>
                    </div>
                    <div class=" card-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="text-uppercase">
                                    <th scope="col">Название сделки</th>
                                    <th scope="col"> Основной контакт</th>
                                    <th scope="col">Компания контакта</th>
                                    <th scope="col">Бюджет,₽</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->contact->name }}</td>
                                    <td>{{ $data->companie->name }}</td>
                                    <th>{{ $data->sale }}</th>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">На данный момент предложение недоступно.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>