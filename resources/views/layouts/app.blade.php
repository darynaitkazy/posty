<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posty</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .button__like {
            padding: 3px;
            background-color: #20EE80;
            color: white;
            border-radius: 20%;
        }
        .button__unlike {
            padding: 3px;
            background-color: #EA4E32;
            color: white;
            border-radius: 20%;
        }
        .button__delete {
            padding: 3px;
            background-color: #EDAD3F;
            border-radius: 20%;
            margin-bottom: 3px;
            color: white;
        }
        body {
            height: 100%;
            /*
            background: #544a7d;
            background: -webkit-linear-gradient(to right, #ffd452, #544a7d);
            background: linear-gradient(to right, #ffd452, #544a7d);   
            */
            background: #D3CCE3;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #E9E4F0, #D3CCE3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
        nav {
            /*
            background: #FDC830;  
background: -webkit-linear-gradient(to right, #F37335, #FDC830); 
background: linear-gradient(to right, #F37335, #FDC830);
            */
            background: #74ebd5;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #ACB6E5, #74ebd5);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #ACB6E5, #74ebd5); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
    </style>
</head>
<body>
    <nav class="p-6 flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="/" class="p-3" style="color: white; font-weight: 800">{{__('profile.Home')}}</a>
            </li>
            <!--
            <li>
                <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
            </li>
            -->
            <li>
                <a href="{{ route('posts') }}" class="p-3" style="color: white; font-weight: 800">{{__('profile.Posts')}}</a>
            </li>
        </ul>
        <ul class="flex items-center">
            @auth
                <li>
                    <a href="{{ route('users.posts', auth()->user()) }}" class="p-3" style="color: white; font-weight: 800">{{ auth()->user()->name }}</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                        <button type="submit" style="color: white; font-weight: 800">{{__('profile.Logout')}}</button>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('login') }}" class="p-3" style="color: white; font-weight: 800">{{__('profile.Login')}}</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3" style="color: white; font-weight: 800">{{__('profile.Register')}}</a>
                </li>
            @endguest
        </ul>
    </nav>
    @yield('content')
</body>
</html>