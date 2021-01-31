@extends('layouts.home')

@section('content')

                <h2>Krishna Shishu Niketan</h2>
                <p>Resize the browser window to see the effect.Resize the browser window to see the effect.Resize the browser window to see the effect.
                Resize the browser window to see the effect.Resize the browser window to see the effect.Resize the browser window to see the effect.
                Resize the browser window to see the effect.Resize the browser window to see the effect.Resize the browser window to see the effect.
                Resize the browser window to see the effect.Resize the browser window to see the effect.Resize the browser window to see the effect.
                Resize the browser window to see the effect.Resize the browser window to see the effect.
                </p>
                <br>
                
                <div class="row">
                <div class="column">
                    <div class="card">
                    <img src="/images/users/team1.jpg" alt="Jane" style="width:100%">
                    <div class="container">
                        <h2>Jane Doe</h2>
                        <p class="title">CEO & Founder</p>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>example@example.com</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                    <img src="/images/users/team2.jpg" alt="Mike" style="width:100%">
                    <div class="container">
                        <h2>Mike Ross</h2>
                        <p class="title">Art Director</p>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>example@example.com</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                    </div>
                </div>
                
                <div class="column">
                    <div class="card">
                    <img src="/images/users/team2.jpg" alt="John" style="width:100%">
                    <div class="container">
                        <h2>John Doe</h2>
                        <p class="title">Designer</p>
                        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p>example@example.com</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                    </div>
                </div>
                </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>


                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
