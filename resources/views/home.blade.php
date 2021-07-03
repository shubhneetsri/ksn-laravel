@extends('layouts.home')

@section('content')

                <h2>Krishna Shishu Niketan</h2>
                <p>Krishna Shishu Niketan provides classes from NC to VIIIth for children between the ages of 3 to 11 being brought up in Hindi and English medium environment. Many of the children have passed out from our school working in several good institutions. Krishna Shishu Niketan is a recognized by the government and was established in 1986. It is run by a team of administrators and fully trained B.ed qualified mother tongue teachers.<br/><br/>
                Our teachers are all native Hindi and English speakers. They are qualified and are highly dedicated to creating a fun, friendly, but also hardworking environment at Krishna Shishu Niketan, Shahjahanpur. Some of our teachers some of are working professionals in diffrent industries.
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
                
                <!--<div class="column">
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
                </div>-->
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
